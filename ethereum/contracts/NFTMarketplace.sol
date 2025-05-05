// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

import "@openzeppelin/contracts/token/ERC721/extensions/ERC721URIStorage.sol";
import "@openzeppelin/contracts/access/Ownable.sol";

contract NFTMarketplace is ERC721URIStorage, Ownable {
    uint256 private _tokenIds;

    struct MarketItem {
        uint256 tokenId;
        address payable seller;
        uint256 price;
        bool sold;
    }

    mapping(uint256 => MarketItem) public marketItems;
    uint256 public listingFee = 0.025 ether;

    constructor() ERC721("NFTMarketplace", "NFTM") Ownable(msg.sender) {}

    function mintNFT(string memory tokenURI) public returns (uint256) {
        _tokenIds++;
        uint256 newTokenId = _tokenIds;
        _mint(msg.sender, newTokenId);
        _setTokenURI(newTokenId, tokenURI);
        return newTokenId;
    }

    function listNFT(uint256 tokenId, uint256 price) public payable {
        require(msg.value == listingFee, "Must pay listing fee");
        require(price > 0, "Price must be greater than zero");
        require(ownerOf(tokenId) == msg.sender, "Only owner can list");

        marketItems[tokenId] = MarketItem(
            tokenId,
            payable(msg.sender),
            price,
            false
        );
        _transfer(msg.sender, address(this), tokenId);
    }

    function buyNFT(uint256 tokenId) public payable {
        MarketItem storage item = marketItems[tokenId];
        require(msg.value == item.price, "Must send exact price");
        require(!item.sold, "Item already sold");

        item.sold = true;
        _transfer(address(this), msg.sender, tokenId);
        item.seller.transfer(item.price);
        payable(owner()).transfer(listingFee);
    }

    function getListingFee() public view returns (uint256) {
        return listingFee;
    }
}