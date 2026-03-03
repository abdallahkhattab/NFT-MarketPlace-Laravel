# NFT Marketplace

<p align="center">
  <img alt="Laravel" src="https://img.shields.io/badge/Laravel-EF3C2E?style=for-the-badge&logo=laravel&logoColor=white"/>
  <img alt="Solidity" src="https://img.shields.io/badge/Solidity-363636?style=for-the-badge&logo=solidity&logoColor=white"/>
  <img alt="Hardhat" src="https://img.shields.io/badge/Hardhat-FD6740?style=for-the-badge&logo=hardhat&logoColor=white"/>
  <img alt="Alchemy" src="https://img.shields.io/badge/Alchemy-000000?style=for-the-badge&logo=alchemy&logoColor=white"/>
  <img alt="MetaMask" src="https://img.shields.io/badge/MetaMask-F6851B?style=for-the-badge&logo=metamask&logoColor=white"/>
  <img alt="Pinata" src="https://img.shields.io/badge/Pinata-FF9900?style=for-the-badge&logo=pinata&logoColor=white"/>
</p>

---

## About NFT Marketplace

The **NFT Marketplace** is a full-stack blockchain application built with **Laravel**, **Blade templates**, and **Solidity smart contracts**. Users can connect via **MetaMask**, mint, list, and sell NFTs on the **Sepolia testnet**.

It uses **Hardhat** for smart contract development and deployment, **Alchemy** as the Ethereum node provider, and **Pinata** to store NFT metadata on **IPFS**.

**Demo Video**: [Watch Here](https://www.youtube.com/watch?v=2gzDGYa-GoE)

**Key Features**:

* **Web3 Authentication**: Login using MetaMask wallet.
* **NFT Minting & Listing**: Create and list NFTs for sale.
* **Marketplace Operations**: Buy, sell, and view NFTs with blockchain integration.
* **Profile Management**: Edit profile and view owned NFTs.
* **Solidity Smart Contract**: Handles NFT ownership, listing, and sales on Sepolia.
* **Real-time Blockchain Data**: Fetch NFTs and transactions directly from the smart contract.
* **Hardhat, Alchemy & Pinata Integration**: Smooth dev workflow and decentralized storage.

---

## Project Structure

```
nft-marketplace/
 ├── ethereum/           # Smart contract + Hardhat project
 │    ├── contracts/
 │    │     └── NFTMarketplace.sol
 │    ├── scripts/       # Deployment scripts
 │    ├── test/          # Unit tests
 │    └── hardhat.config.js
 └── laravel/            # Laravel web application
      ├── app/
      ├── routes/
      ├── resources/views/   # Blade templates
      └── ...
```

---

## Installation

### Clone the repository

```bash
git clone
cd nft-marketplace/laravel
```

### Install PHP dependencies

```bash
composer install
```

### Install Node dependencies (Hardhat & scripts)

```bash
cd ../ethereum
npm install
```

### Configure Hardhat, Alchemy & Pinata

* Create a `.env` file in the `ethereum/` folder with your credentials:

```bash
ALCHEMY_API_KEY=your_alchemy_api_key
PRIVATE_KEY=your_wallet_private_key
PINATA_API_KEY=your_pinata_api_key
PINATA_SECRET_KEY=your_pinata_secret_key
```

* Update `hardhat.config.js` to connect to Sepolia via Alchemy.
* Pinata is used in your smart contract scripts to upload NFT metadata.

### Deploy Smart Contract (optional)

```bash
npx hardhat run scripts/deploy.js --network sepolia
```

### Set up Laravel environment

```bash
cp .env.example .env
php artisan key:generate
```

### Run migrations and seed database

```bash
php artisan migrate
php artisan db:seed
```

### Start the Laravel server

```bash
php artisan serve
```

**Access the app:** `http://localhost:8000` and connect via MetaMask.

---

## Smart Contract

* **Contract Name**: `NFTMarketplace.sol`
* **Network**: Sepolia Testnet
* **Address**: [0x636937bac8A853767CF2422D4eDcCd2CC9e190d0](https://sepolia.etherscan.io/address/0x636937bac8A853767CF2422D4eDcCd2CC9e190d0#code)
* **Key Functions**:

  * `createToken(tokenURI, price)` – Mint a new NFT
  * `executeSale(tokenId)` – Buy a listed NFT
  * `getAllNFTs()` – Get all listed NFTs
  * `getMyNFTs()` – Get NFTs owned or sold by the user
  * `updateListPrice()` – Update marketplace listing fee (owner only)

---

## Features

### User Actions

* Connect MetaMask wallet
* Mint NFT with metadata stored on IPFS via Pinata
* List NFTs for sale
* Buy NFTs from other users
* Edit profile and view owned NFTs

---


## Tech Stack

* **Frontend**: Laravel + Blade templates
* **Backend**: Laravel PHP
* **Blockchain**: Solidity ERC721, Hardhat
* **Ethereum Node Provider**: Alchemy
* **Wallet Integration**: MetaMask
* **NFT Storage**: Pinata (IPFS)
* **Database**: MySQL / SQLite
* **Deployment**: Sepolia Testnet

---

## Developed by : `Abdallah khattab`
