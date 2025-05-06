require("@nomicfoundation/hardhat-toolbox");
require("dotenv").config();

const { ALCHEMY_SEPOLIA_API_KEY, SEPOLIA_PRIVATE_KEY, ETHERSCAN_API_KEY } = process.env;

if (!ALCHEMY_SEPOLIA_API_KEY || !SEPOLIA_PRIVATE_KEY || !ETHERSCAN_API_KEY) {
  console.error("Please set all required environment variables.");
  process.exit(1);
}

const cleanPrivateKey = SEPOLIA_PRIVATE_KEY.startsWith("0x") ? SEPOLIA_PRIVATE_KEY.slice(2) : SEPOLIA_PRIVATE_KEY;
if (!/^[0-9a-fA-F]{64}$/.test(cleanPrivateKey)) {
  console.error("Invalid SEPOLIA_PRIVATE_KEY format.");
  process.exit(1);
}

module.exports = {
  solidity: {
    compilers: [
      { version: "0.8.28" },
      { version: "0.8.20" } // Add this to support OpenZeppelin contracts
    ]
  },
  networks: {
    hardhat: {
      chainId: 1337
    },
    sepolia: {
      url: `https://eth-sepolia.g.alchemy.com/v2/${ALCHEMY_SEPOLIA_API_KEY}`,
      accounts: [`0x${cleanPrivateKey}`],
    //  gasPrice: 8000000000,
    gasLimit: 5000000 
    },
  },
  paths: {
    artifacts: "./src/artifacts",
  },
  etherscan: {
    apiKey: ETHERSCAN_API_KEY
  }
};
