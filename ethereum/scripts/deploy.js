const hre = require("hardhat");

async function main() {
  // Get the contract factory
  const NFTMarketplace = await hre.ethers.getContractFactory("NFTMarketplace");
  
  // Deploy the contract
  const nftMarketplace = await NFTMarketplace.deploy();
  await nftMarketplace.waitForDeployment();
  
  // Get the deployed contract address
  const address = await nftMarketplace.getAddress();
  
  console.log("NFTMarketplace deployed to:", address);
  
  // Store the contract addresses to access them later from Laravel
  const fs = require("fs");
  
  // Make sure the directory exists
  const contractsDir = "../laravel/storage/app/contracts";
  if (!fs.existsSync(contractsDir)) {
    fs.mkdirSync(contractsDir, { recursive: true });
  }
  
  // Save the contract address for future reference
  fs.writeFileSync(
    `${contractsDir}/contract-address.json`,
    JSON.stringify({ NFTMarketplace: address }, null, 2)
  );
  
  // Copy the contract artifact (ABI)
  const artifactDir = "../laravel/storage/app/contracts";
  if (!fs.existsSync(artifactDir)) {
    fs.mkdirSync(artifactDir, { recursive: true });
  }
  
  fs.copyFileSync(
    `${hre.config.paths.artifacts}/contracts/NFTMarketplace.sol/NFTMarketplace.json`,
    `${artifactDir}/NFTMarketplace.json`
  );
}

main()
  .then(() => process.exit(0))
  .catch((error) => {
    console.error(error);
    process.exit(1);
  });