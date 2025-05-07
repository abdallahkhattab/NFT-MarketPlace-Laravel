const hre = require("hardhat");

async function main() {
  const [signer] = await hre.ethers.getSigners();
  const myAddress = "0x1f3A2a3D9525b54DbF180365971f28B44fD8a1B2";
  
  const confirmedNonce = await hre.ethers.provider.getTransactionCount(myAddress);
  const pendingNonce = await hre.ethers.provider.getTransactionCount(myAddress, "pending");
  
  console.log(`Confirmed nonce: ${confirmedNonce}`);
  console.log(`Pending nonce: ${pendingNonce}`);
  console.log(`Cancelling ${pendingNonce - confirmedNonce} transactions...`);
  
  // Calculate maximum affordable gas price
  // Your balance: 255939791203250 wei
  // Gas limit: 21000
  // Max gas price = balance / gas limit = ~12.2 gwei
  let gasPrice;
  try {
    gasPrice = hre.ethers.utils.parseUnits("10", "gwei"); // Use 10 gwei
  } catch (e) {
    try {
      gasPrice = hre.ethers.parseUnits("10", "gwei");
    } catch (e2) {
      gasPrice = 10000000000n;
    }
  }
  
  for (let nonce = confirmedNonce; nonce < pendingNonce; nonce++) {
    try {
      const tx = {
        to: myAddress,
        value: 0,
        gasPrice: gasPrice,
        gasLimit: 21000,
        nonce: nonce
      };
      
      const txResponse = await signer.sendTransaction(tx);
      console.log(`Cancelled transaction with nonce ${nonce}: ${txResponse.hash}`);
    } catch (error) {
      console.error(`Failed to cancel nonce ${nonce}:`, error.message);
    }
  }
}

main()
  .then(() => process.exit(0))
  .catch((error) => {
    console.error(error);
    process.exit(1);
  });