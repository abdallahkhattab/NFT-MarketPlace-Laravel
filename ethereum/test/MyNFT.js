const { expect } = require("chai");
const { ethers } = require("hardhat");

describe("NFTMarketplace", function () {
  let NFTMarketplace;
  let nftMarketplace;
  let owner;
  let addr1;
  let addr2;

  beforeEach(async function () {
    // Get contract factories
    NFTMarketplace = await ethers.getContractFactory("NFTMarketplace");
    
    // Get signers
    [owner, addr1, addr2] = await ethers.getSigners();
    
    // Deploy contracts
    nftMarketplace = await NFTMarketplace.deploy();
    await nftMarketplace.waitForDeployment();
  });

  it("Should mint an NFT", async function () {
    // Mint a new token
    const tokenURI = "https://example.com/token/1";
    const tx = await nftMarketplace.mintNFT(tokenURI);
    const receipt = await tx.wait();
    
    // Check if minted to the correct owner
    const tokenId = 1; // First token should have ID 1
    expect(await nftMarketplace.ownerOf(tokenId)).to.equal(owner.address);
    
    // Check the token URI
    expect(await nftMarketplace.tokenURI(tokenId)).to.equal(tokenURI);
  });

  it("Should list an NFT for sale", async function () {
    // Mint a new token
    const tokenURI = "https://example.com/token/1";
    await nftMarketplace.mintNFT(tokenURI);
    const tokenId = 1;
    
    // List the token for sale
    const price = ethers.parseEther("1");
    const listingFee = await nftMarketplace.getListingFee();
    
    await nftMarketplace.listNFT(tokenId, price, { value: listingFee });
    
    // Check if the marketplace is now the owner
    expect(await nftMarketplace.ownerOf(tokenId)).to.equal(await nftMarketplace.getAddress());
    
    // Check market item details
    const marketItem = await nftMarketplace.marketItems(tokenId);
    expect(marketItem.seller).to.equal(owner.address);
    expect(marketItem.price).to.equal(price);
    expect(marketItem.sold).to.equal(false);
  });

  it("Should buy an NFT", async function () {
    // Mint a new token
    const tokenURI = "https://example.com/token/1";
    await nftMarketplace.mintNFT(tokenURI);
    const tokenId = 1;
    
    // List the token for sale
    const price = ethers.parseEther("1");
    const listingFee = await nftMarketplace.getListingFee();
    
    await nftMarketplace.listNFT(tokenId, price, { value: listingFee });
    
    // Get seller's initial balance
    const sellerInitialBalance = await ethers.provider.getBalance(owner.address);
    
    // Buy the NFT from addr1
    await nftMarketplace.connect(addr1).buyNFT(tokenId, { value: price });
    
    // Check new owner
    expect(await nftMarketplace.ownerOf(tokenId)).to.equal(addr1.address);
    
    // Check if seller received payment
    const sellerFinalBalance = await ethers.provider.getBalance(owner.address);
    expect(sellerFinalBalance).to.be.gt(sellerInitialBalance);
    
    // Check market item updated
    const marketItem = await nftMarketplace.marketItems(tokenId);
    expect(marketItem.sold).to.equal(true);
  });

  it("Should only allow owner to list NFT", async function () {
    // Mint a new token
    const tokenURI = "https://example.com/token/1";
    await nftMarketplace.mintNFT(tokenURI);
    const tokenId = 1;
    
    // Try to list the token from addr1 (not the owner)
    const price = ethers.parseEther("1");
    const listingFee = await nftMarketplace.getListingFee();
    
    await expect(
      nftMarketplace.connect(addr1).listNFT(tokenId, price, { value: listingFee })
    ).to.be.revertedWith("Only owner can list");
  });
});