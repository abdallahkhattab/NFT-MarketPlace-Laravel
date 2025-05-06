const hre = require("hardhat");
const fs = require("fs").promises;
const path = require("path");

async function main() {
  // Verify network
  const networkName = hre.network.name;
  console.log(`Deploying to network: ${networkName}`);
  if (networkName === "sepolia") {
    console.log("Ensure you have sufficient Sepolia ETH in your wallet.");
  }

  // Get the contract factory
  const NFTMarketplace = await hre.ethers.getContractFactory("NFTMarketplace");

  // Deploy the contract
  const nftMarketplace = await NFTMarketplace.deploy();
  await nftMarketplace.waitForDeployment();

  // Get the deployed contract address
  const address = await nftMarketplace.getAddress();
  console.log("NFTMarketplace deployed to:", address);

  // Define paths for Laravel
  const contractsDir = path.resolve(__dirname, "../laravel/storage/app/contracts");
  const artifactPath = path.join(hre.config.paths.artifacts, "contracts", "NFTMarketplace.sol", "NFTMarketplace.json");
  const artifactDestPath = path.join(contractsDir, "NFTMarketplace.json");
  const addressFilePath = path.join(contractsDir, "contract-address.json");

  try {
    // Create contracts directory if it doesn't exist
    await fs.mkdir(contractsDir, { recursive: true });

    // Save the contract address
    await fs.writeFile(
      addressFilePath,
      JSON.stringify({ NFTMarketplace: address }, null, 2)
    );
    console.log(`Contract address saved to ${addressFilePath}`);

    // Copy the contract artifact (ABI)
    await fs.copyFile(artifactPath, artifactDestPath);
    console.log(`Contract artifact copied to ${artifactDestPath}`);
  } catch (error) {
    console.error("Error during file operations:", error);
    throw error;
  }

  // Return contract address for potential further use
  return address;
}

main()
  .then(() => process.exit(0))
  .catch((error) => {
    console.error("Deployment failed:", error);
    process.exit(1);
  });