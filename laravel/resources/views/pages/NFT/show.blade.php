
@extends('layouts.layout')

@section('title', $nft['name'] . ' - NFT Marketplace')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    body {
        font-family: 'Orbitron', sans-serif;
        background: linear-gradient(180deg, #0a0a23 0%, #1e1e4a 100%);
        overflow-x: hidden;
    }
    .holographic-card {
        background: linear-gradient(45deg, rgba(162, 89, 255, 0.2), rgba(59, 130, 246, 0.2));
        border: 2px solid transparent;
        border-image: linear-gradient(to right, #a259ff, #3b82f6) 1;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .holographic-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 0 20px rgba(162, 89, 255, 0.5), 0 0 40px rgba(59, 130, 246, 0.3);
    }
    .neon-text {
        text-shadow: 0 0 5px #a259ff, 0 0 10px #3b82f6;
    }
    .glitch {
        animation: glitch 1s linear infinite;
    }
    @keyframes glitch {
        2%, 64% { transform: translate(2px, 0) skew(0deg); }
        4%, 60% { transform: translate(-2px, 0) skew(0deg); }
        62% { transform: translate(0, 0) skew(5deg); }
    }
    .particle-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }
    .particle {
        position: absolute;
        width: 8px;
        height: 8px;
        background: #a259ff;
        opacity: 0.3;
        border-radius: 50%;
        animation: float 10s infinite linear;
    }
    @keyframes float {
        0% { transform: translateY(0); opacity: 0.3; }
        50% { opacity: 0.6; }
        100% { transform: translateY(-100vh); opacity: 0; }
    }
    .holographic-modal {
        background: rgba(10, 10, 35, 0.9);
        border: 2px solid #a259ff;
        box-shadow: 0 0 30px rgba(162, 89, 255, 0.5);
    }
    .chain-animation {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50px;
        background: linear-gradient(to right, transparent, #a259ff, transparent);
        animation: chain-flow 5s linear infinite;
    }
    @keyframes chain-flow {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: rgba(162, 89, 255, 0.2);
        border: 1px solid #a259ff;
        color: #a259ff;
        padding: 12px 20px;
        border-radius: 8px;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .toast.show {
        opacity: 1;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen text-white relative overflow-hidden">
    <!-- Particle Background -->
    <div class="particle-bg" id="particle-bg"></div>

    <!-- Main NFT Details Section -->
    <div class="container mx-auto px-4 py-12 relative">
        <!-- Blockchain Chain Animation -->
        <div class="chain-animation"></div>

        <!-- Main NFT Image -->
        <div class="mb-12">
            <div class="holographic-card rounded-lg overflow-hidden flex justify-center relative">
                <img id="nft-image" src="{{ $nft['image'] }}" alt="{{ $nft['name'] }}" class="max-w-full max-h-[40rem] object-contain py-4 cursor-pointer nft-image">
                <div class="absolute top-4 right-4 flex space-x-2">
                    <button class="bg-gray-900 hover:bg-gray-800 text-white p-2 rounded-lg" onclick="openModal(document.getElementById('nft-image').src)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="M21 21l-4.35-4.35"></path>
                            <path d="M11 8v6"></path>
                            <path d="M8 11h6"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column with NFT Info -->
            <div class="lg:col-span-2">
                <h1 id="nft-name" class="text-5xl font-bold neon-text mb-2">{{ $nft['name'] }}</h1>
                <p id="nft-details" class="text-gray-400 mb-6">Token ID: #{{ $nft['tokenId'] }}</p>
                
                <div class="mb-6">
                    <p class="text-gray-400">Created By</p>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 flex items-center justify-center mr-2">
                            <span class="text-sm">🛸</span>
                        </div>
                        <span id="nft-seller" class="font-medium text-purple-300 hover:text-purple-100">{{ substr($nft['seller'], 0, 6) . '...' . substr($nft['seller'], -4) }}</span>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h2 class="text-gray-400 mb-2 text-xl">Description</h2>
                    <div id="nft-description" class="space-y-4 text-gray-200">
                        @foreach(explode("\n", $nft['description']) as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>
                
                <div class="mb-8">
                    <h2 class="text-gray-400 mb-2 text-xl">Details</h2>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <i class="fas fa-globe mr-2 text-purple-400"></i>
                            <a id="etherscan-link" href="https://sepolia.etherscan.io/token/{{ $web3config['contractAddress'] }}?a={{ $nft['tokenId'] }}" target="_blank" class="text-gray-300 hover:text-purple-400">View on Etherscan</a>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-file-alt mr-2 text-purple-400"></i>
                            <a id="ipfs-link" href="#" class="text-gray-300 hover:text-purple-400">View Metadata on IPFS</a>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h2 class="text-gray-400 mb-2 text-xl">Tags</h2>
                    <div id="nft-tags" class="flex flex-wrap gap-2">
                        <span class="px-4 py-2 bg-gray-900 rounded-full text-sm border border-purple-500 text-purple-300">{{ strtoupper($nft['category']) }}</span>
                        <span class="px-4 py-2 bg-gray-900 rounded-full text-sm border border-blue-500 text-blue-300">BLOCKCHAIN</span>
                        <span class="px-4 py-2 bg-gray-900 rounded-full text-sm border border-pink-500 text-pink-300">COSMOS</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Column with Purchase Info -->
            <div>
                <div class="holographic-card rounded-lg p-6 relative overflow-hidden">
                    <div class="mb-4">
                        <p class="text-gray-400 mb-2 text-lg">Available Until:</p>
                        <div class="flex justify-between text-center text-purple-300">
                            <div>
                                <p id="hours" class="text-3xl font-bold glitch">00</p>
                                <p class="text-gray-400 text-sm">Hours</p>
                            </div>
                            <div class="text-2xl font-bold">:</div>
                            <div>
                                <p id="minutes" class="text-3xl font-bold glitch">00</p>
                                <p class="text-gray-400 text-sm">Minutes</p>
                            </div>
                            <div class="text-2xl font-bold">:</div>
                            <div>
                                <p id="seconds" class="text-3xl font-bold glitch">00</p>
                                <p class="text-gray-400 text-sm">Seconds</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-gray-400 mb-2 text-lg">Price:</p>
                        <p id="nft-price" class="text-2xl font-bold text-purple-300">{{ number_format($nft['price'], 3) }} ETH</p>
                    </div>
                    <button id="buyButton" class="w-full bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 text-white font-medium py-3 px-4 rounded-lg transition transform hover:scale-105">
                        <i class="fas fa-wallet mr-2"></i>  Buy
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Galactic Map Section -->
    <div class="container mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold neon-text mb-6 text-center">Galactic Map of NFTs</h2>
        <div class="relative h-96 bg-gray-900 rounded-lg overflow-hidden">
            <div class="absolute inset-0 bg-[url('/img/galaxy-bg.jpg')] bg-cover opacity-30"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-gray-200">
                    <p class="text-xl mb-4">Explore the NFT Universe</p>
                    <p>Interactive map coming soon! Discover NFT collections across the cosmos.</p>
                </div>
            </div>
        </div>
    </div>

    
    
    <!-- More From This Artist Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold neon-text">More From This Artist</h2>
            <a id="wallet_address"
            data-route-base="{{ url('profile/creator') }}"
            href="#"
            class="border border-purple-500 rounded-lg px-6 py-2 flex items-center hover:bg-purple-500 hover:text-white transition">
             <span>Go To Artist Page</span>
             <span class="ml-2">→</span> 
         </a>
         
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Placeholder NFT Card -->
            <div class="holographic-card rounded-lg overflow-hidden relative group">
                <div class="relative pb-[100%] bg-gray-900">
                    <img src="/img/nft/cat-future.jpg" alt="Cat From Future" class="absolute inset-0 w-full h-full object-contain p-2 cursor-pointer nft-image" onclick="openModal(this.src)">
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold mb-2 neon-text">Cat From Future</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-5 h-5 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 flex items-center justify-center mr-2">
                            <span class="text-xs">🛸</span>
                        </div>
                        <span class="text-sm text-gray-300">{{ substr($nft['seller'], 0, 6) . '...' . substr($nft['seller'], -4) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <div>
                            <p class="text-gray-400">Price</p>
                            <p class="text-purple-300">1.63 ETH</p>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-400">Highest Bid</p>
                            <p class="text-blue-300">0.33 wETH</p>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gray-900 bg-opacity-90 opacity-0 group-hover:opacity-100 transition-opacity p-4 text-gray-200">
                        <p class="text-sm">Token ID: #2</p>
                        <p class="text-sm">Blockchain: Ethereum</p>
                        <p class="text-sm truncate">Contract: {{ $web3config['contractAddress'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- NFT Image Viewer Modal -->
    <div id="nftModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center">
        <div class="max-w-4xl w-full mx-4 holographic-modal rounded-lg p-6">
            <button onclick="closeModal()" class="absolute -top-12 right-0 text-white text-3xl hover:text-purple-400">×</button>
            <img id="modalImage" src="" alt="NFT Image" class="max-w-full max-h-[80vh] mx-auto object-contain nft-image">
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast"></div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ethers/5.7.2/ethers.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.7/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
<script>
// Web3 Configuration
const web3Config = @json($web3config);
const tokenId = {{ $nft['tokenId'] }};
let provider, signer, contract;
let nftData = @json($nft);
let isEdge = /Edg\//.test(navigator.userAgent);

// Wait for MetaMask to be available
async function waitForMetaMask(maxRetries = 5, retryDelay = 1000) {
    for (let attempt = 1; attempt <= maxRetries; attempt++) {
        if (window.ethereum) {
            console.log('MetaMask detected on attempt', attempt);
            return true;
        }
        console.warn(`MetaMask not detected on attempt ${attempt}/${maxRetries}. Retrying...`);
        await new Promise(resolve => setTimeout(resolve, retryDelay));
    }
    console.error('MetaMask not available after retries.');
    showToast(isEdge ? 'MetaMask not detected in Edge. Please ensure MetaMask is installed and enabled in Extensions.' : 'MetaMask is not installed. Please install MetaMask to proceed.');
    return false;
}

// Initialize Web3
async function initWeb3() {
    console.log('Initializing Web3...');
    const metaMaskAvailable = await waitForMetaMask();
    if (!metaMaskAvailable) {
        console.error('Web3 initialization aborted: MetaMask not available.');
        return false;
    }

    try {
        provider = new ethers.providers.Web3Provider(window.ethereum);
        console.log('Requesting MetaMask accounts...');
        await provider.send("eth_requestAccounts", []);
        const network = await provider.getNetwork();
        console.log('Connected to network:', network);
        if (network.chainId !== 11155111) { // Sepolia
            showToast(isEdge ? 'Please switch MetaMask to the Sepolia network in Edge. Check extension permissions if the prompt fails.' : 'Please switch MetaMask to the Sepolia network.');
            return false;
        }
        signer = provider.getSigner();
        contract = new ethers.Contract(
            web3Config.contractAddress,
            web3Config.contractABI,
            signer
        );
        console.log('Web3 initialized successfully:', {
            contractAddress: web3Config.contractAddress,
            network: network.name,
            chainId: network.chainId
        });
        return true;
    } catch (error) {
        console.error('Web3 initialization failed:', error);
        showToast(isEdge ? `Failed to connect to blockchain in Edge: ${error.message}. Try refreshing or checking MetaMask permissions.` : `Failed to connect to blockchain: ${error.message}`);
        return false;
    }
}

// Fetch with CORS proxy
async function fetchWithCorsProxy(ipfsUrl) {
    const corsProxies = [
        'https://api.allorigins.win/raw?url=',
        'https://corsproxy.io/?',
        'https://thingproxy.freeboard.io/fetch/'
    ];

    for (const proxy of corsProxies) {
        try {
            console.log(`Trying CORS proxy: ${proxy} for URL: ${ipfsUrl}`);
            const response = await fetch(`${proxy}${encodeURIComponent(ipfsUrl)}`, {
                headers: { 'Accept': 'application/json' }
            });
            if (response.ok) {
                const data = await response.json();
                if (data && data.name && data.description && data.image) {
                    console.log('Successfully fetched with CORS proxy:', data);
                    return data;
                }
            }
        } catch (error) {
            console.error(`Proxy ${proxy} failed for URL ${ipfsUrl}:`, error.message);
        }
    }
    console.error('All CORS proxies failed for URL:', ipfsUrl);
    return null;
}

// Fetch metadata from IPFS
async function fetchMetadata(ipfsHash) {
    const dedicatedGateway = `https://ipfs.io/ipfs/${ipfsHash}`;
    const pinataJwt = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySW5mb3JtYXRpb24iOnsiaWQiOiI1Mzg2ZDA2MS0zZmE2LTRiNDktOWY2YS0yOTQxNmJhZjRlODkiLCJlbWFpbCI6ImJvb2R5a2hhdHRhYjk3QGdtYWlsLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJwaW5fcG9saWN5Ijp7InJlZ2lvbnMiOlt7ImRlc2lyZWRSZXBsaWNhdGlvbkNvdW50IjoxLCJpZCI6IkZSQTEifSx7ImRlc2lyZWRSZXBsaWNhdGlvbkNvdW50IjoxLCJpZCI6Ik5ZQzEifV0sInZlcnNpb24iOjF9LCJtZmFfZW5hYmxlZCI6ZmFsc2UsInN0YXR1cyI6IkFDVElWRSJ9LCJhdXRoZW50aWNhdGlvblR5cGUiOiJzY29wZWRLZXkiLCJzY29wZWRLZXlLZXkiOiIyZTcwYTAzZWMzN2VmYjAzMjkxOCIsInNjb3BlZEtleVNlY3JldCI6IjdmY2FjOGQzNGQ1NDRmM2I1NmU3ZWQ4N2RjNmI2NzVjNzdiNWFlMGNmYmZmYjMwODc2YTljZjVhZDZjMmJlYTIiLCJleHAiOjE3NzgxNTY3OTh9.vtlL2PhURiG6NKVTbsoKPkaUJJgIy67iTZwdkR6ig5M';

    const corsMetadata = await fetchWithCorsProxy(dedicatedGateway);
    if (corsMetadata) {
        console.log(`Metadata fetched via CORS proxy for token ${tokenId}`);
        return corsMetadata;
    }

    try {
        console.log(`Trying dedicated Pinata gateway for token ${tokenId}: ${dedicatedGateway}`);
        const response = await axios.get(dedicatedGateway, {
            timeout: 10000,
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${pinataJwt}`
            }
        });
        if (response.data && response.data.name && response.data.description && response.data.image) {
            console.log(`Successfully fetched metadata from dedicated gateway for token ${tokenId}`);
            return response.data;
        }
    } catch (error) {
        console.warn(`Dedicated gateway failed for token ${tokenId}:`, error.message);
    }

    console.warn(`All fetch attempts failed for token ${tokenId}. Using fallback metadata.`);
    showToast(`Unable to load metadata for Token #${tokenId}.`);
    return {
        name: `Token #${tokenId}`,
        description: "Metadata unavailable",
        image: "https://via.placeholder.com/400x400?text=NFT+Image",
        category: "Unknown",
        isFallback: true
    };
}

// Fetch and display NFT details
async function loadNFTDetails() {
    console.log('Loading NFT details...');
    const initialized = await initWeb3();
    if (!initialized) {
        console.error('NFT details not loaded due to Web3 initialization failure.');
        return;
    }

    try {
        console.log(`Fetching details for token ID: ${tokenId}`);
        const tokenURI = await contract.tokenURI(tokenId);
        console.log(`Token URI for token ${tokenId}: ${tokenURI}`);
        if (!tokenURI || !tokenURI.startsWith('ipfs://')) {
            console.warn(`Invalid or empty tokenURI for token ${tokenId}: ${tokenURI}`);
            showToast(`Invalid metadata URI for Token #${tokenId}.`);
            return;
        }

        const ipfsHash = tokenURI.replace('ipfs://', '');
        const metadata = await fetchMetadata(ipfsHash);
        if (!metadata) {
            console.warn(`No valid metadata for token ${tokenId}`);
            return;
        }

        let price = '0.0';
        let seller = 'Unknown';
        try {
            const nftDetails = await contract.getAllNFTs();
            const token = nftDetails.find(t => t.tokenId.toNumber() === parseInt(tokenId));
            if (token) {
                price = ethers.utils.formatEther(token.price);
                seller = token.seller;
            }
        } catch (error) {
            console.error('Failed to fetch NFT details:', error);
        }

        nftData = {
            tokenId: tokenId,
            name: metadata.name,
            description: metadata.description,
            image: metadata.image.startsWith('ipfs://') 
                ? `https://ipfs.io/ipfs/${metadata.image.replace('ipfs://', '')}`
                : metadata.image,
            category: metadata.category || 'Art',
            price: price,
            seller: seller,
            mintedAt: 'Sep 30, 2022'
        };

        // Update the link dynamically
        const link = document.getElementById('wallet_address');
        const baseRoute = link.dataset.routeBase;
        link.href = `${baseRoute}/${nftData.seller}`;

        // Update DOM
        document.getElementById('nft-name').textContent = nftData.name;
        document.getElementById('nft-image').src = nftData.image;
        document.getElementById('nft-image').alt = nftData.name;
        document.getElementById('nft-details').textContent = `Minted on ${nftData.mintedAt} | Token ID: #${nftData.tokenId}`;
        document.getElementById('nft-seller').textContent = nftData.seller ? `${nftData.seller.slice(0, 6)}...${nftData.seller.slice(-4)}` : 'Unknown';
        document.getElementById('nft-price').textContent = `${parseFloat(nftData.price).toFixed(3)} ETH`;
        document.getElementById('etherscan-link').href = `https://sepolia.etherscan.io/token/${web3Config.contractAddress}?a=${nftData.tokenId}`;
        document.getElementById('ipfs-link').href = nftData.image.startsWith('https://ipfs.io/ipfs') 
            ? nftData.image 
            : `https://ipfs.io/ipfs/${ipfsHash}`;

        const descriptionDiv = document.getElementById('nft-description');
        descriptionDiv.innerHTML = '';
        nftData.description.split('\n').forEach(para => {
            const p = document.createElement('p');
            p.textContent = para;
            descriptionDiv.appendChild(p);
        });

        const tagsDiv = document.getElementById('nft-tags');
        tagsDiv.innerHTML = `
            <span class="px-4 py-2 bg-gray-900 rounded-full text-sm border border-purple-500 text-purple-300">${nftData.category.toUpperCase()}</span>
            <span class="px-4 py-2 bg-gray-900 rounded-full text-sm border border-blue-500 text-blue-300">BLOCKCHAIN</span>
            <span class="px-4 py-2 bg-gray-900 rounded-full text-sm border border-pink-500 text-pink-300">COSMOS</span>
        `;
    } catch (error) {
        console.error(`Error loading NFT #${tokenId}:`, error);
        showToast(`Failed to load NFT details: ${error.message}`);
    }
}

// Buy NFT
async function buyNFT() {
    console.log('buyNFT called');
    if (!contract || !signer) {
        console.warn('Cannot buy NFT: Wallet not connected.');
        showToast(isEdge ? 'Wallet not connected in Edge. Please ensure MetaMask is enabled and try again.' : 'Wallet not connected. Please connect MetaMask.');
        return;
    }
    try {
        console.log('Validating NFT price...');
        if (!nftData.price || parseFloat(nftData.price) <= 0) {
            console.warn('Invalid NFT price:', nftData.price);
            showToast('Invalid NFT price.');
            return;
        }

        console.log('Getting wallet balance...');
        const walletAddress = await signer.getAddress();
        const balance = await provider.getBalance(walletAddress);
        const balanceInEth = ethers.utils.formatEther(balance);
        console.log(`Wallet balance: ${balanceInEth} ETH`);
        showToast(`Wallet balance: ${parseFloat(balanceInEth).toFixed(3)} ETH`, 'info');

        console.log('Estimating gas...');
        const priceInWei = ethers.utils.parseEther(nftData.price.toString());
        let gasEstimate;
        try {
            gasEstimate = await contract.estimateGas.executeSale(nftData.tokenId, { value: priceInWei });
            console.log('Gas estimate:', gasEstimate.toString());
        } catch (error) {
            console.warn('Gas estimation failed:', error);
            gasEstimate = ethers.BigNumber.from('200000'); // Fallback
            showToast(isEdge ? 'Gas estimation failed in Edge. Using default gas limit.' : 'Gas estimation failed. Using default gas limit.', 'info');
        }

        console.log('Calculating total cost...');
        const gasPrice = await provider.getGasPrice();
        const gasCost = gasEstimate.mul(gasPrice);
        const totalCost = priceInWei.add(gasCost);
        const totalCostInEth = ethers.utils.formatEther(totalCost);
        console.log(`Total cost: ${totalCostInEth} ETH`);

        if (balance.lt(totalCost)) {
            console.warn(`Insufficient funds. Need ${totalCostInEth} ETH, have ${balanceInEth} ETH`);
            showToast(`Insufficient funds. Need ${parseFloat(totalCostInEth).toFixed(3)} ETH, but only have ${parseFloat(balanceInEth).toFixed(3)} ETH. Please fund your wallet using a Sepolia faucet (e.g., https://sepolia-faucet.alchemy.com).`, 'error');
            return;
        }

        console.log('Executing transaction...');
        showToast('Initiating purchase. Please confirm in MetaMask...', 'info');
        const tx = await contract.executeSale(nftData.tokenId, { 
            value: priceInWei,
            gasLimit: gasEstimate.mul(115).div(100) // 15% buffer
        });
        console.log('Transaction submitted:', tx.hash);

        showToast('Transaction submitted. Waiting for confirmation...', 'info');
        await tx.wait();
        console.log('Transaction confirmed');

        showToast(`Successfully purchased Token #${nftData.tokenId}!`, 'success');
    } catch (error) {
        console.error('Error purchasing NFT:', error);
        let message = 'Failed to purchase NFT.';
        if (error.code === 4001) {
            message = 'Transaction rejected by user.';
        } else if (error.message.includes('insufficient funds')) {
            message = 'Insufficient funds. Please add more ETH to your wallet.';
        } else if (error.reason) {
            message = `Error: ${error.reason}`;
        } else if (error.code === -32603) {
            message = isEdge ? 'Network error in Edge. Try refreshing or checking MetaMask settings.' : 'Network error. Please try again later.';
        } else if (isEdge) {
            message = `Failed in Edge: ${error.message}. Ensure MetaMask is enabled and try again.`;
        }
        showToast(message, 'error');
    }
}

// Particle Background Animation
function createParticles() {
    const particleBg = document.getElementById('particle-bg');
    if (!particleBg) return;
    for (let i = 0; i < 50; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.animationDelay = `${Math.random() * 10}s`;
        particle.style.animationDuration = `${5 + Math.random() * 10}s`;
        particleBg.appendChild(particle);
    }
}

// Auction Timer
function updateTimer() {
    const endTime = new Date('2025-05-10T00:00:00Z').getTime();
    const now = new Date().getTime();
    const timeLeft = endTime - now;

    if (timeLeft <= 0) {
        document.getElementById('hours').textContent = '00';
        document.getElementById('minutes').textContent = '00';
        document.getElementById('seconds').textContent = '00';
        return;
    }

    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

    document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
    document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
}

// Modal Functionality
function openModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('nftModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    gsap.from('#modalImage', { scale: 0.8, opacity: 0, duration: 0.5, ease: 'power2.out' });
}

function closeModal() {
    gsap.to('#modalImage', {
        scale: 0.8,
        opacity: 0,
        duration: 0.3,
        ease: 'power2.in',
        onComplete: () => {
            document.getElementById('nftModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });
}

// Show Toast Notification
function showToast(message, type = 'error') {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.className = `toast ${type === 'success' ? 'bg-green-500' : type === 'info' ? 'bg-blue-500' : 'bg-red-500'} bg-opacity-20 border-${type === 'success' ? 'green' : type === 'info' ? 'blue' : 'red'}-500`;
    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 5000);
}

// Disable Context Menu on NFT Images
function disableContextMenu() {
    const nftImages = document.querySelectorAll('.nft-image');
    nftImages.forEach(img => {
        img.addEventListener('contextmenu', (e) => {
            e.preventDefault();
            showToast('Image saving is disabled to protect NFT ownership.');
        });
    });
}

// Initialize Page
async function initializePage() {
    console.log('Initializing page...');
    createParticles();
    updateTimer();
    setInterval(updateTimer, 1000);
    disableContextMenu();

    const cards = document.querySelectorAll('.holographic-card');
    cards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;

            gsap.to(card, {
                rotationX: rotateX,
                rotationY: rotateY,
                duration: 0.3,
                ease: 'power2.out',
                transformPerspective: 1000
            });
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                rotationX: 0,
                rotationY: 0,
                duration: 0.5,
                ease: 'power2.out'
            });
        });
    });

    // Load NFT details
    await loadNFTDetails();

    // Initialize buy button with retry
    function bindBuyButton() {
        const buyButton = document.getElementById('buyButton');
        if (!buyButton) {
            console.warn('Buy button not found. Retrying...');
            setTimeout(bindBuyButton, 500);
            return;
        }
        console.log('Binding buy button event listener...');
        buyButton.removeEventListener('click', handleBuyClick); // Prevent duplicate listeners
        buyButton.addEventListener('click', handleBuyClick);
    }

    async function handleBuyClick(e) {
        console.log('Buy button clicked');
        e.preventDefault();
        const initialized = await initWeb3();
        if (initialized) {
            await buyNFT();
        }
    }

    bindBuyButton();
}

// Run initialization when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializePage);
} else {
    initializePage();
}
</script>
@endpush
@endsection
