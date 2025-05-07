// SPDX-License-Identifier: Unlicense
pragma solidity ^0.8.0;

import "hardhat/console.sol";
import "@openzeppelin/contracts/token/ERC721/extensions/ERC721URIStorage.sol";
import "@openzeppelin/contracts/token/ERC721/ERC721.sol";

contract NFTMarketplace is ERC721URIStorage {
    uint256 private _tokenIds;
    uint256 private _itemsSold;
    address payable public owner; // Made public to fix test failure
    uint256 listPrice = 0.01 ether;

    struct ListedToken {
        uint256 tokenId;
        address payable owner;
        address payable seller;
        uint256 price;
        bool currentlyListed;
    }

    event TokenListedSuccess(
        uint256 indexed tokenId,
        address owner,
        address seller,
        uint256 price,
        bool currentlyListed
    );

    mapping(uint256 => ListedToken) private idToListedToken;

    constructor() ERC721("NFTMarketplace", "NFTM") {
        owner = payable(msg.sender);
    }

    function updateListPrice(uint256 _listPrice) public {
        require(owner == msg.sender, "Only owner can update listing price");
        listPrice = _listPrice;
    }

    function getListPrice() public view returns (uint256) {
        return listPrice;
    }

    function getLatestIdToListedToken() public view returns (ListedToken memory) {
        uint256 currentTokenId = _tokenIds;
        return idToListedToken[currentTokenId];
    }

    function getListedTokenForId(uint256 tokenId) public view returns (ListedToken memory) {
        return idToListedToken[tokenId];
    }

    function getCurrentToken() public view returns (uint256) {
        return _tokenIds;
    }

    function createToken(string memory tokenURI, uint256 price) public payable returns (uint) {
        require(msg.value >= listPrice, "Insufficient listing fee");
        require(price > 0, "Price must be positive");

        _tokenIds += 1;
        uint256 newTokenId = _tokenIds;
        _safeMint(msg.sender, newTokenId);
        _setTokenURI(newTokenId, tokenURI);
        createListedToken(newTokenId, price);

        if (msg.value > listPrice) {
            (bool success, ) = payable(msg.sender).call{value: msg.value - listPrice}("");
            require(success, "Refund failed");
        }

        return newTokenId;
    }

    function createListedToken(uint256 tokenId, uint256 price) private {
        idToListedToken[tokenId] = ListedToken(
            tokenId,
            payable(address(this)),
            payable(msg.sender),
            price,
            true
        );

        _transfer(msg.sender, address(this), tokenId);
        emit TokenListedSuccess(tokenId, address(this), msg.sender, price, true);
    }

    function getAllNFTs() public view returns (ListedToken[] memory) {
        uint nftCount = _tokenIds;
        uint listedCount = 0;
        for (uint i = 0; i < nftCount; i++) {
            if (idToListedToken[i + 1].currentlyListed) {
                listedCount++;
            }
        }
        ListedToken[] memory tokens = new ListedToken[](listedCount);
        uint currentIndex = 0;
        for (uint i = 0; i < nftCount; i++) {
            if (idToListedToken[i + 1].currentlyListed) {
                tokens[currentIndex] = idToListedToken[i + 1];
                currentIndex++;
            }
        }
        return tokens;
    }

    function getMyNFTs() public view returns (ListedToken[] memory) {
        uint totalItemCount = _tokenIds;
        uint itemCount = 0;
        for (uint i = 0; i < totalItemCount; i++) {
            if (idToListedToken[i + 1].owner == msg.sender || idToListedToken[i + 1].seller == msg.sender) {
                itemCount += 1;
            }
        }
        ListedToken[] memory items = new ListedToken[](itemCount);
        uint currentIndex = 0;
        for (uint i = 0; i < totalItemCount; i++) {
            if (idToListedToken[i + 1].owner == msg.sender || idToListedToken[i + 1].seller == msg.sender) {
                items[currentIndex] = idToListedToken[i + 1];
                currentIndex++;
            }
        }
        return items;
    }

    function executeSale(uint256 tokenId) public payable {
        uint price = idToListedToken[tokenId].price;
        address seller = idToListedToken[tokenId].seller;
        require(msg.value == price, "Please submit the asking price");

        idToListedToken[tokenId].currentlyListed = false; // Fixed: Token is unlisted after sale
        idToListedToken[tokenId].seller = payable(msg.sender);
        _itemsSold += 1;

        _transfer(address(this), msg.sender, tokenId);

        (bool success, ) = payable(owner).call{value: listPrice}("");
        require(success, "Transfer to owner failed");
        (bool success2, ) = payable(seller).call{value: msg.value}("");
        require(success2, "Transfer to seller failed");
    }
}