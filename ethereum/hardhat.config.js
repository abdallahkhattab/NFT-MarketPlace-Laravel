require("@nomicfoundation/hardhat-toolbox");
require("dotenv").config();

const { ALCHEMY_SEPOLIA_API_KEY, SEPOLIA_PRIVATE_KEY, ETHERSCAN_API_KEY } = process.env;

// Validate environment variables
if (!ALCHEMY_SEPOLIA_API_KEY) {
  console.error("Error: ALCHEMY_SEPOLIA_API_KEY is not set in .env");
  process.exit(1);
}
if (!SEPOLIA_PRIVATE_KEY) {
  console.error("Error: SEPOLIA_PRIVATE_KEY is not set in .env");
  process.exit(1);
}
if (!ETHERSCAN_API_KEY) {
  console.error("Error: ETHERSCAN_API_KEY is not set in .env");
  process.exit(1);
}

// Validate private key format (64 hex chars, optionally with 0x)
const cleanPrivateKey = SEPOLIA_PRIVATE_KEY.startsWith("0x") ? SEPOLIA_PRIVATE_KEY.slice(2) : SEPOLIA_PRIVATE_KEY;
if (!/^[0-9a-fA-F]{64}$/.test(cleanPrivateKey)) {
  console.error("Error: SEPOLIA_PRIVATE_KEY is invalid. Must be a 64-character hexadecimal string.");
  process.exit(1);
}

module.exports = {
  solidity: {
    version: "0.8.28",
    settings: {
      optimizer: {
        enabled: true,
        runs: 200
      }
    }
  },
  networks: {
    hardhat: {
      chainId: 1337
    },
    sepolia: {
      url: `https://eth-sepolia.g.alchemy.com/v2/${ALCHEMY_SEPOLIA_API_KEY}`,
      accounts: [`0x${cleanPrivateKey}`],
      maxFeePerGas: 6000000000, // 6 gwei
      maxPriorityFeePerGas: 1000000000 // 1 gwei
    },
  },
  paths: {
    artifacts: "./src/artifacts",
  },
  etherscan: {
    apiKey: ETHERSCAN_API_KEY
  }
};