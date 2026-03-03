<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

Ah, perfect — thanks for clarifying! Since your NFT Marketplace doesn’t use Filament, we can remove all references to it and focus purely on **Laravel, Blade, MetaMask, Hardhat, and Alchemy**.

Here’s the cleaned-up, recruiter-friendly README:

---

# NFT Marketplace

<p align="center">
  <img alt="Laravel" src="https://img.shields.io/badge/Laravel-EF3C2E?style=for-the-badge&logo=laravel&logoColor=white"/>
  <img alt="Solidity" src="https://img.shields.io/badge/Solidity-363636?style=for-the-badge&logo=solidity&logoColor=white"/>
  <img alt="Hardhat" src="https://img.shields.io/badge/Hardhat-FD6740?style=for-the-badge&logo=hardhat&logoColor=white"/>
  <img alt="Alchemy" src="https://img.shields.io/badge/Alchemy-000000?style=for-the-badge&logo=alchemy&logoColor=white"/>
  <img alt="MetaMask" src="https://img.shields.io/badge/MetaMask-F6851B?style=for-the-badge&logo=metamask&logoColor=white"/>
</p>
---

## About NFT Marketplace

The **NFT Marketplace** is a full-stack blockchain application built with **Laravel**, **Blade templates**, and **Solidity smart contracts**. Users can connect via **MetaMask**, mint, list, and sell NFTs on the **Sepolia testnet**.

It uses **Hardhat** for smart contract development and deployment, and **Alchemy** as the Ethereum node provider for blockchain interaction.

**Demo Video** : https://www.youtube.com/watch?v=2gzDGYa-GoE

**Key features**:

* **Web3 Authentication**: Login using MetaMask wallet.
* **NFT Minting & Listing**: Users can create new NFTs and list them for sale.
* **Marketplace Operations**: Buy, sell, and view NFTs with live blockchain integration.
* **Profile Management**: Edit profile and view owned NFTs.
* **Solidity Smart Contract**: Handles NFT ownership, listing, and sales on Sepolia.
* **Real-time Blockchain Data**: Fetch NFTs and transactions directly from the smart contract.
* **Hardhat & Alchemy Integration**: Hardhat for testing/deployment, Alchemy for node access.

---

## Project Structure

```
nft-marketplace/
 ├── ethereum/           # Smart contract and Hardhat project
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

To set up the NFT Marketplace locally, follow these steps:

1. **Clone the repository**:

```bash
git clone
cd nft-marketplace/laravel
```

2. **Install PHP dependencies**:

```bash
composer install
```

3. **Install Node dependencies (Hardhat & scripts)**:

```bash
cd ../ethereum
npm install
```

4. **Configure Hardhat & Alchemy**:

* Create a `.env` file in `ethereum/` with your Alchemy API key and wallet private key:

```bash
ALCHEMY_API_KEY=your_alchemy_api_key
PRIVATE_KEY=your_wallet_private_key
```

* Update `hardhat.config.js` to connect to Sepolia via Alchemy.

5. **Deploy Smart Contract (if needed)**:

```bash
npx hardhat run scripts/deploy.js --network sepolia
```

6. **Set up Laravel environment**:

* Copy `.env.example` to `.env` and configure your database.
* Generate app key:

```bash
php artisan key:generate
```

7. **Run migrations and seed the database**:

```bash
php artisan migrate
php artisan db:seed
```

8. **Start the Laravel development server**:

```bash
php artisan serve
```

9. **Access the application**:
   Visit `http://localhost:8000` and connect with MetaMask.

---

## Smart Contract

* **Contract Name**: `NFTMarketplace.sol`
* **Network**: Sepolia Testnet
* **Address**: [0x636937bac8A853767CF2422D4eDcCd2CC9e190d0](https://sepolia.etherscan.io/address/0x636937bac8A853767CF2422D4eDcCd2CC9e190d0#code)
* **Functions**:

  * `createToken(tokenURI, price)` – Mint a new NFT
  * `executeSale(tokenId)` – Buy a listed NFT
  * `getAllNFTs()` – Get all listed NFTs
  * `getMyNFTs()` – Get NFTs owned or sold by the user
  * `updateListPrice()` – Update marketplace listing fee (owner only)

---

## Features

### User Actions

* Connect MetaMask wallet
* Mint NFT with custom metadata
* List NFT for sale
* Buy NFTs from other users
* Edit profile and view owned NFTs

---

## Tech Stack

* **Frontend**: Laravel + Blade templates
* **Backend**: Laravel PHP
* **Blockchain**: Solidity ERC721, Hardhat
* **Ethereum Node Provider**: Alchemy
* **Wallet Integration**: MetaMask
* **Database**: MySQL / SQLite
* **Deployment**: Sepolia Testnet



