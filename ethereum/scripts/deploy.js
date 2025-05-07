const hre = require("hardhat");
const fs = require("fs").promises;
const path = require("path");

async function checkExistingContract(addressFilePath) {
  try {
    const exists = await fs.access(addressFilePath).then(() => true).catch(() => false);
    if (!exists) return null;

    const data = await fs.readFile(addressFilePath, "utf8");
    const { NFTMarketplace } = JSON.parse(data);
    console.warn(`⚠️  Existing contract address found at ${NFTMarketplace}`);
    return NFTMarketplace;
  } catch (error) {
    console.error("Error checking existing contract:", error);
    return null;
  }
}

async function backupExistingFiles(contractsDir, addressFilePath, artifactDestPath) {
  try {
    const timestamp = new Date().toISOString().replace(/[:.]/g, "-");
    const backupDir = path.join(contractsDir, "backups", timestamp);
    await fs.mkdir(backupDir, { recursive: true });

    const addressBackupPath = path.join(backupDir, "contract-address.json");
    const artifactBackupPath = path.join(backupDir, "NFTMarketplace.json");

    const addressExists = await fs.access(addressFilePath).then(() => true).catch(() => false);
    const artifactExists = await fs.access(artifactDestPath).then(() => true).catch(() => false);

    if (addressExists) {
      await fs.copyFile(addressFilePath, addressBackupPath);
      console.log(`📁 Backed up contract address to ${addressBackupPath}`);
    }
    if (artifactExists) {
      await fs.copyFile(artifactDestPath, artifactBackupPath);
      console.log(`📁 Backed up contract artifact to ${artifactBackupPath}`);
    }
  } catch (error) {
    console.error("Error during backup:", error);
  }
}

async function main() {
  const networkName = hre.network.name;
  console.log(`🚀 Deploying to network: ${networkName}`);
  if (networkName !== "sepolia") {
    throw new Error("This script is intended for the Sepolia network only.");
  }

  const deployer = (await hre.ethers.getSigners())[0];
  const deployerAddress = deployer.address;
  const balance = await hre.ethers.provider.getBalance(deployerAddress);

  console.log(`👤 Deployer address: ${deployerAddress}`);
  console.log(`💰 Deployer balance: ${hre.ethers.formatEther(balance)} ETH`);
  if (balance < hre.ethers.parseEther("0.01")) {
    throw new Error("Insufficient Sepolia ETH. Request from a faucet.");
  }

  const confirmedNonce = await hre.ethers.provider.getTransactionCount(deployerAddress);
  const pendingNonce = await hre.ethers.provider.getTransactionCount(deployerAddress, "pending");
  console.log(`🧾 Nonce: Confirmed = ${confirmedNonce}, Pending = ${pendingNonce}`);
  if (confirmedNonce !== pendingNonce) {
    console.warn("⚠️  Warning: Pending transactions detected. Deployment may be delayed.");
  }

  const contractsDir = path.resolve(__dirname, "../laravel/storage/app/contracts");
  const addressFilePath = path.join(contractsDir, "contract-address.json");
  const artifactDestPath = path.join(contractsDir, "NFTMarketplace.json");

  const existingAddress = await checkExistingContract(addressFilePath);
  if (existingAddress) {
    console.log("📦 Proceeding with new deployment...");
  }

  await backupExistingFiles(contractsDir, addressFilePath, artifactDestPath);

  const NFTMarketplace = await hre.ethers.getContractFactory("NFTMarketplace");
  const feeData = await hre.ethers.provider.getFeeData();

  const nftMarketplace = await NFTMarketplace.deploy({
    maxFeePerGas: feeData.maxFeePerGas || hre.ethers.parseUnits("10", "gwei"),
    maxPriorityFeePerGas: feeData.maxPriorityFeePerGas || hre.ethers.parseUnits("1", "gwei"),
  });

  console.log(`📨 Deployment transaction hash: ${nftMarketplace.deploymentTransaction().hash}`);
  await nftMarketplace.waitForDeployment();

  const deployedAddress = await nftMarketplace.getAddress();
  console.log(`✅ NFTMarketplace deployed to: ${deployedAddress}`);

  const artifactPath = path.join(hre.config.paths.artifacts, "contracts", "NFTMarketplace.sol", "NFTMarketplace.json");
  await fs.mkdir(contractsDir, { recursive: true });
  await fs.writeFile(addressFilePath, JSON.stringify({ NFTMarketplace: deployedAddress }, null, 2));
  console.log(`📝 Contract address saved to ${addressFilePath}`);
  await fs.copyFile(artifactPath, artifactDestPath);
  console.log(`📄 Contract artifact copied to ${artifactDestPath}`);

  console.log(`🔍 To verify on Etherscan, run:`);
  console.log(`npx hardhat verify --network sepolia ${deployedAddress}`);
}

main()
  .then(() => process.exit(0))
  .catch((error) => {
    console.error("❌ Deployment failed:", error);
    process.exit(1);
  });
