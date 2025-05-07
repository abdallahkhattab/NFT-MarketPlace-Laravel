const { ethers } = require("hardhat");

async function main() {
    const contractAddress = "0x636937bac8A853767CF2422D4eDcCd2CC9e190d0";

    const NFTMarketplace = await ethers.getContractFactory("NFTMarketplace");
    const contract = await NFTMarketplace.attach(contractAddress);

    const currentTokenId = await contract.getCurrentToken();
    console.log(`Total tokens: ${currentTokenId.toString()}`);

    for (let tokenId = 1; tokenId <= currentTokenId; tokenId++) {
        try {
            const token = await contract.getListedTokenForId(tokenId);

            if (token.currentlyListed) {
                const tokenURI = await contract.tokenURI(tokenId);
                console.log(`Token ID: ${tokenId}`);
                console.log(` - URI: ${tokenURI}`);
                console.log(` - Price: ${ethers.utils.formatEther(token.price)} ETH`);
                console.log(` - Seller: ${token.seller}`);
                console.log(` - Owner: ${token.owner}`);
                console.log("----------------------------");
            }
        } catch (err) {
            console.error(`Failed to load token ${tokenId}:`, err.message);
        }
    }
}

main().catch((error) => {
    console.error(error);
    process.exitCode = 1;
});
