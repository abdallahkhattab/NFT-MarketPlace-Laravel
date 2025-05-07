// resources/js/web3-utils.js

import Web3 from 'web3';
import detectEthereumProvider from '@metamask/detect-provider';

export default class NFTMarketplaceWeb3 {
    constructor(contractABI, contractAddress, providerUrl = null) {
        this.contractABI = contractABI;
        this.contractAddress = contractAddress;
        this.providerUrl = providerUrl;
        this.web3 = null;
        this.contract = null;
        this.account = null;
    }

    async init() {
        try {
            // Try to use MetaMask or other injected provider first
            const provider = await detectEthereumProvider();
            
            if (provider) {
                console.log('Ethereum provider detected');
                this.web3 = new Web3(provider);
                
                // Request account access
                try {
                    const accounts = await provider.request({ method: 'eth_requestAccounts' });
                    this.account = accounts[0];
                    console.log(`Connected with account: ${this.account}`);
                } catch (error) {
                    console.error('User denied account access', error);
                }
            } else if (this.providerUrl) {
                // Fallback to HTTP provider (read-only)
                console.log('Using HTTP provider (read-only mode)');
                this.web3 = new Web3(new Web3.providers.HttpProvider(this.providerUrl));
            } else {
                throw new Error('No Ethereum provider available');
            }
            
            // Initialize contract
            this.contract = new this.web3.eth.Contract(
                this.contractABI,
                this.contractAddress
            );
            
            return true;
        } catch (error) {
            console.error('Failed to initialize Web3', error);
            return false;
        }
    }

    // Get all NFTs from the marketplace
    async getAllNFTs() {
        try {
            return await this.contract.methods.getAllNFTs().call();
        } catch (error) {
            console.error('Error fetching NFTs:', error);
            throw error;
        }
    }

    // Get user's NFTs
    async getMyNFTs() {
        try {
            if (!this.account) {
                throw new Error('No account connected');
            }
            return await this.contract.methods.getMyNFTs().call({ from: this.account });
        } catch (error) {
            console.error('Error fetching my NFTs:', error);
            throw error;
        }
    }

    // Create a new token (mint NFT)
    async createToken(tokenURI, price, listingFee) {
        try {
            if (!this.account) {
                throw new Error('No account connected');
            }
            
            const priceInWei = this.web3.utils.toWei(price.toString(), 'ether');
            
            return await this.contract.methods.createToken(tokenURI, priceInWei)
                .send({ 
                    from: this.account, 
                    value: listingFee,
                    gas: 500000
                });
        } catch (error) {
            console.error('Error creating token:', error);
            throw error;
        }
    }

    // Buy an NFT
    async buyNFT(tokenId, price) {
        try {
            if (!this.account) {
                throw new Error('No account connected');
            }
            
            const priceInWei = this.web3.utils.toWei(price.toString(), 'ether');
            
            return await this.contract.methods.executeSale(tokenId)
                .send({ 
                    from: this.account, 
                    value: priceInWei,
                    gas: 500000
                });
        } catch (error) {
            console.error('Error buying NFT:', error);
            throw error;
        }
    }

    // Get listing price
    async getListPrice() {
        try {
            const listPrice = await this.contract.methods.getListPrice().call();
            return this.web3.utils.fromWei(listPrice, 'ether');
        } catch (error) {
            console.error('Error getting listing price:', error);
            throw error;
        }
    }
}