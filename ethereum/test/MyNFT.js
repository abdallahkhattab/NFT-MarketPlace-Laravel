const { expect } = require("chai");
const { ethers } = require("hardhat");

describe("NFTMarketplace", function () {
  let nftMarketplace;
  let owner;
  let addr1;
  let addr2;
  let addrs;

  const listPrice = ethers.parseEther("0.01"); // Listing fee
  const nftPrice = ethers.parseEther("1");     // NFT price

  beforeEach(async function () {
    [owner, addr1, addr2, ...addrs] = await ethers.getSigners();
    const NFTMarketplace = await ethers.getContractFactory("NFTMarketplace");
    nftMarketplace = await NFTMarketplace.deploy();
    await nftMarketplace.waitForDeployment();
  });

  describe("Deployment", function () {
    it("Should set the right owner", async function () {
      expect(await nftMarketplace.owner()).to.equal(owner.address); // ✅ correct
    });

    it("Should set the correct list price", async function () {
      expect(await nftMarketplace.getListPrice()).to.equal(listPrice);
    });
  });

  describe("Marketplace operations", function () {
    it("Should create and list a new token", async function () {
      const tokenURI = "https://example.com/token/1";
      const tx = await nftMarketplace.connect(addr1).createToken(tokenURI, nftPrice, {
        value: listPrice,
      });
      await tx.wait();

      const tokenId = await nftMarketplace.getCurrentToken();
      expect(tokenId).to.equal(1);

      const listedToken = await nftMarketplace.getListedTokenForId(tokenId);
      expect(listedToken.tokenId).to.equal(tokenId);
      expect(listedToken.seller).to.equal(addr1.address);
      expect(listedToken.price).to.equal(nftPrice);
      expect(listedToken.currentlyListed).to.equal(true);

      expect(await nftMarketplace.ownerOf(tokenId)).to.equal(await nftMarketplace.getAddress());
    });

    it("Should allow purchase of a listed token", async function () {
      const tokenURI = "https://example.com/token/1";
      await nftMarketplace.connect(addr1).createToken(tokenURI, nftPrice, {
        value: listPrice,
      });

      const tokenId = await nftMarketplace.getCurrentToken();

      const sellerBalanceBefore = await ethers.provider.getBalance(addr1.address);
      const ownerBalanceBefore = await ethers.provider.getBalance(owner.address);

      await nftMarketplace.connect(addr2).executeSale(tokenId, { value: nftPrice });

      expect(await nftMarketplace.ownerOf(tokenId)).to.equal(addr2.address);

      const sellerBalanceAfter = await ethers.provider.getBalance(addr1.address);
      const ownerBalanceAfter = await ethers.provider.getBalance(owner.address);

      expect(sellerBalanceAfter - sellerBalanceBefore).to.equal(nftPrice);
      expect(ownerBalanceAfter - ownerBalanceBefore).to.equal(listPrice);

      const listedToken = await nftMarketplace.getListedTokenForId(tokenId);
      expect(listedToken.seller).to.equal(addr2.address);
    });

    it("Should get all NFTs", async function () {
      await nftMarketplace.connect(addr1).createToken("https://example.com/token/1", nftPrice, {
        value: listPrice,
      });

      await nftMarketplace.connect(addr2).createToken("https://example.com/token/2", nftPrice, {
        value: listPrice,
      });

      const tokens = await nftMarketplace.getAllNFTs();
      expect(tokens.length).to.equal(2);
      expect(tokens[0].tokenId).to.equal(1);
      expect(tokens[1].tokenId).to.equal(2);
    });

    it("Should get my NFTs", async function () {
      await nftMarketplace.connect(addr1).createToken("https://example.com/token/1", nftPrice, {
        value: listPrice,
      });

      await nftMarketplace.connect(addr2).createToken("https://example.com/token/2", nftPrice, {
        value: listPrice,
      });

      const myTokens = await nftMarketplace.connect(addr1).getMyNFTs();
      expect(myTokens.length).to.equal(1);
      expect(myTokens[0].seller).to.equal(addr1.address);
    });

    it("Should update list price", async function () {
      const newListPrice = ethers.parseEther("0.02");
      await nftMarketplace.connect(owner).updateListPrice(newListPrice);
      expect(await nftMarketplace.getListPrice()).to.equal(newListPrice);
    });

    it("Should revert when non-owner tries to update list price", async function () {
      const newListPrice = ethers.parseEther("0.02");
      await expect(
        nftMarketplace.connect(addr1).updateListPrice(newListPrice)
      ).to.be.revertedWith("Only owner can update listing price");
    });
  });
});
