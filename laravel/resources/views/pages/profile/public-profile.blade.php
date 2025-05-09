
@extends('layouts.layout')

@section('title', 'Profile')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
<style>
    /* Enhanced gradient background with subtle animation */
    .gradient-bg {
        background: linear-gradient(135deg, #6d28d9, #8b5cf6, #4c1d95);
        background-size: 200% 200%;
        animation: gradientShift 15s ease infinite;
    }
    
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .banner-img {
        height: 280px;
        object-fit: cover;
        transition: all 0.5s ease;
    }
    
    /* Hover effects */
    .hover-scale {
        transition: transform 0.3s ease;
    }
    .hover-scale:hover {
        transform: scale(1.03);
    }
    
    /* Button animations */
    .pulse-btn {
        box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.7);
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(139, 92, 246, 0); }
        100% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0); }
    }
    
    /* Smooth fade-in animations */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeIn 0.8s ease forwards;
    }
    
    @keyframes fadeIn {
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Delayed fade-in animations */
    .fade-in-1 { animation-delay: 0.1s; }
    .fade-in-2 { animation-delay: 0.2s; }
    .fade-in-3 { animation-delay: 0.3s; }
    .fade-in-4 { animation-delay: 0.4s; }
    
    /* Elegant toast notification */
    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: rgba(17, 24, 39, 0.95);
        border-left: 4px solid #8b5cf6;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        z-index: 9999;
        max-width: 350px;
        display: flex;
        align-items: center;
        overflow: hidden;
        transform: translateX(400px);
        opacity: 0;
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }
    
    .toast.show {
        transform: translateX(0);
        opacity: 1;
    }
    
    .toast-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 100%;
        background: linear-gradient(to right, #6d28d9, #8b5cf6);
        animation: toast-timer 3s linear forwards;
    }
    
    @keyframes toast-timer {
        to { width: 0%; }
    }
    
    /* Glowing effect for profile avatar */
    .avatar-glow {
        position: relative;
    }
    
    .avatar-glow::after {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        background: linear-gradient(45deg, #6d28d9, #8b5cf6, #4c1d95, #8b5cf6);
        background-size: 400% 400%;
        z-index: -1;
        border-radius: 14px;
        animation: glowingBorder 3s ease infinite;
        opacity: 0.7;
        filter: blur(5px);
    }
    
    @keyframes glowingBorder {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Tab hover effects */
    .tab-hover {
        position: relative;
        transition: all 0.3s ease;
    }
    
    .tab-hover::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 50%;
        background: #8b5cf6;
        transition: all 0.3s ease;
    }
    
    .tab-hover:hover::after {
        width: 100%;
        left: 0;
    }
    
    .tab-active {
        border-bottom: 2px solid #8b5cf6;
        color: white;
    }
    
    /* Card hover effects */
    .nft-card {
        background: rgba(31, 29, 43, 0.6);
        backdrop-filter: blur(5px);
        transition: all 0.3s ease;
        transform-style: preserve-3d;
        border: 1px solid rgba(139, 92, 246, 0.1);
        position: relative;
        overflow: hidden;
        height: 100%;
    }
    
    .nft-card:hover {
        transform: translateY(-5px) rotateX(5deg);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
    }
    
    .nft-img-container {
        overflow: hidden;
        position: relative;
    }
    
    .nft-img-container:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(0deg, rgba(26, 26, 26, 0.4) 0%, rgba(26, 26, 26, 0) 40%);
        z-index: 1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .nft-card:hover .nft-img-container:before {
        opacity: 1;
    }
    
    .nft-img-container img {
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .nft-card:hover .nft-img-container img {
        transform: scale(1.12);
    }
    
    .nft-content {
        padding: 12px;
        position: relative;
        z-index: 2;
    }
    
    .nft-title {
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 6px;
        transition: all 0.3s ease;
    }
    
    .nft-card:hover .nft-title {
        color: #bd83ff;
    }
    
    .nft-creator {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    
    .creator-badge {
        background: linear-gradient(45deg, #8b5cf6, #6d28d9);
        border: 2px solid #1a1a1a;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    
    .nft-card:hover .creator-badge {
        transform: scale(1.1);
        box-shadow: 0 0 8px rgba(139, 92, 246, 0.5);
    }
    
    .creator-name {
        color: #a0a0a0;
        font-size: 0.75rem;
        transition: all 0.3s ease;
        margin-left: 8px;
    }
    
    .nft-card:hover .creator-name {
        color: #bd83ff;
    }
    
    .nft-details {
        display: flex;
        justify-content: space-between;
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid rgba(139, 92, 246, 0.1);
    }
    
    .price-label, .bid-label {
        color: #808080;
        font-size: 0.7rem;
        margin-bottom: 2px;
    }
    
    .price-value {
        color: white;
        font-weight: 600;
        font-size: 0.85rem;
    }
    
    .bid-value {
        color: #bd83ff;
        font-weight: 600;
        font-size: 0.85rem;
    }
    
    .nft-card:hover .price-value, .nft-card:hover .bid-value {
        color: #bd83ff;
    }
    
    .category-tag {
        background: rgba(139, 92, 246, 0.15);
        border: 1px solid rgba(139, 92, 246, 0.3);
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.65rem;
        color: #bd83ff;
        position: absolute;
        top: 8px;
        left: 8px;
        z-index: 2;
        backdrop-filter: blur(4px);
        transition: all 0.3s ease;
    }
    
    .nft-card:hover .category-tag {
        background: rgba(139, 92, 246, 0.3);
        box-shadow: 0 0 8px rgba(139, 92, 246, 0.3);
    }
    
    .buy-button {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(90deg, #8b5cf6, #6d28d9);
        color: white;
        text-align: center;
        padding: 8px 0;
        font-weight: 500;
        transform: translateY(100%);
        transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        opacity: 0;
        z-index: 3;
        cursor: pointer;
    }
    
    .nft-card:hover .buy-button {
        transform: translateY(0);
        opacity: 1;
    }
    
    .favorite-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        z-index: 2;
        background: rgba(31, 29, 43, 0.7);
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(139, 92, 246, 0.3);
        backdrop-filter: blur(4px);
        transform: scale(0.8);
        opacity: 0;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .nft-card:hover .favorite-btn {
        opacity: 1;
        transform: scale(1);
    }
    
    .favorite-btn:hover {
        background: rgba(139, 92, 246, 0.3);
        transform: scale(1.1) !important;
    }
    
    .favorite-icon {
        color: white;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    
    .favorite-btn:hover .favorite-icon {
        color: #ff6b81;
    }
    
    /* Loader Overlay */
    .loader-overlay {
        position: absolute;
        inset: 0;
        background: rgba(18, 18, 18, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: 12px;
        transition: opacity 0.3s ease;
    }
    
    .loader {
        border: 4px solid rgba(139, 92, 246, 0.2);
        border-top: 4px solid #8b5cf6;
        border-radius: 50%;
        width: 48px;
        height: 48px;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .loader-text {
        color: #bd83ff;
        font-size: 0.9rem;
        margin-top: 12px;
        animation: pulse-light 1.5s ease-in-out infinite;
    }
    
    @keyframes pulse-light {
        0%, 100% { opacity: 0.8; }
        50% { opacity: 1; }
    }
    
    /* Troubleshooting Panel */
    .troubleshooting-panel {
        background: rgba(31, 29, 43, 0.8);
        border: 1px solid #ff5555;
        border-radius: 8px;
        padding: 16px;
        max-width: 600px;
        margin: 0 auto;
        text-align: left;
        color: #bd83ff;
    }
    
    .troubleshooting-panel h3 {
        color: #ff5555;
        font-weight: bold;
        margin-bottom: 12px;
    }
    
    .troubleshooting-panel ul {
        list-style-type: disc;
        padding-left: 20px;
        color: #a0a0a0;
    }
    
    .troubleshooting-panel li {
        margin-bottom: 8px;
    }
    
    .troubleshooting-panel a {
        color: #bd83ff;
        text-decoration: underline;
    }
    
    @media (max-width: 768px) {
        .nft-card {
            max-width: none;
        }
        .loader {
            width: 36px;
            height: 36px;
        }
        .loader-text {
            font-size: 0.8rem;
        }
    }
</style>
@endpush

@push('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/ethers@5.7.2/dist/ethers.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', async function() {
    // Ensure toast-container exists
    const toastContainer = document.getElementById('toast-container');
    if (!toastContainer) {
        const container = document.createElement('div');
        container.id = 'toast-container';
        document.body.appendChild(container);
    }

    // Ensure particle container exists (try both canvas and div)
    let particleContainer = document.getElementById('particles-js');
    if (!particleContainer) {
        particleContainer = document.createElement('canvas');
        particleContainer.id = 'particles-js';
        particleContainer.style.position = 'absolute';
        particleContainer.style.top = '0';
        particleContainer.style.left = '0';
        particleContainer.style.width = '100%';
        particleContainer.style.height = '100%';
        particleContainer.style.zIndex = '0';
        try {
            document.getElementById('banner-container').appendChild(particleContainer);
        } catch (e) {
            console.warn('Failed to append canvas, trying div:', e);
            particleContainer = document.createElement('div');
            particleContainer.id = 'particles-js';
            particleContainer.style.position = 'absolute';
            particleContainer.style.top = '0';
            particleContainer.style.left = '0';
            particleContainer.style.width = '100%';
            particleContainer.style.height = '100%';
            particleContainer.style.zIndex = '0';
            document.getElementById('banner-container').appendChild(particleContainer);
        }
    }

    // Check ethers.js
    if (!window.ethers) {
        showToast('Failed to load blockchain library.', 'error');
        document.getElementById('nft-grid').innerHTML = '<p class="text-gray-400 text-center col-span-4">Unable to load NFTs.</p>';
        return;
    }

    // Initialize Axios with CSRF
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!csrfToken) {
        showToast('Authentication setup failed.', 'error');
        return;
    }

    // Web3 configuration
    const web3Config = @json($web3Config ?? [
        'contractAddress' => '0x636937bac8A853767CF2422D4eDcCd2CC9e190d0',
        'contractABI' => [] // Replace with actual ABI
    ]);
    if (!web3Config.contractAddress || !web3Config.contractABI.length) {
        showToast('Blockchain configuration missing.', 'error');
        return;
    }

    let provider, signer, contract;
    let listedNFTs = [];
    let ownedNFTs = [];
    let currentPage = 1;
    const perPage = 12;
    let activeTab = 'created';

    // DOM elements
    const nftGrid = document.getElementById('nft-grid');
    const loaderOverlay = document.getElementById('loader-overlay');
    const createdTab = document.getElementById('created-tab');
    const ownedTab = document.getElementById('owned-tab');
    const collectionTab = document.getElementById('collection-tab');
    const createdCount = document.getElementById('created-count');
    const ownedCount = document.getElementById('owned-count');
    const copyAddressBtn = document.getElementById('copy-address-btn');

    // Show/hide loader
    function showLoader() {
        loaderOverlay.style.display = 'flex';
        loaderOverlay.style.opacity = '1';
    }
    function hideLoader() {
        loaderOverlay.style.opacity = '0';
        setTimeout(() => loaderOverlay.style.display = 'none', 300);
    }

    // Toast notification
    function showToast(message, type = 'success') {
        const existingToast = document.querySelector('.toast');
        if (existingToast) existingToast.remove();

        const toast = document.createElement('div');
        toast.className = 'toast';
        const icon = type === 'success'
            ? `<i class="fas fa-check-circle w-6 h-6 mr-2 text-green-400"></i>`
            : `<i class="fas fa-times-circle w-6 h-6 mr-2 text-red-400"></i>`;

        toast.innerHTML = `
            ${icon}
            <div><p class="font-medium">${message}</p></div>
            <button class="ml-auto toast-close-btn">
                <i class="fas fa-times w-4 h-4"></i>
            </button>
            <div class="toast-progress"></div>
        `;
        document.getElementById('toast-container').appendChild(toast);

        setTimeout(() => toast.classList.add('show'), 10);
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    }

    // Initialize Web3
    async function initWeb3(maxRetries = 3, retryDelay = 1000) {
        for (let attempt = 1; attempt <= maxRetries; attempt++) {
            try {
                if (!window.ethereum) {
                    showToast('MetaMask is not installed.', 'error');
                    showTroubleshootingPanel('MetaMask is not installed in your browser.');
                    return false;
                }
                provider = new ethers.providers.Web3Provider(window.ethereum);
                await provider.send("eth_requestAccounts", []);
                const network = await provider.getNetwork();
                if (network.chainId !== 11155111) {
                    showToast('Please switch MetaMask to Sepolia network.', 'error');
                    showTroubleshootingPanel('MetaMask is connected to the wrong network.');
                    return false;
                }
                signer = provider.getSigner();
                contract = new ethers.Contract(web3Config.contractAddress, web3Config.contractABI, signer);
                const code = await provider.getCode(web3Config.contractAddress);
                if (code === '0x') {
                    showToast('Contract not found at specified address.', 'error');
                    showTroubleshootingPanel('No contract is deployed at the specified address.');
                    return false;
                }
                return true;
            } catch (error) {
                if (attempt < maxRetries) {
                    await new Promise(resolve => setTimeout(resolve, retryDelay));
                    continue;
                }
                showToast(`Failed to connect to blockchain: ${error.message}`, 'error');
                showTroubleshootingPanel(`Unable to connect to blockchain: ${error.message}`);
                return false;
            }
        }
    }

    // Fetch with CORS proxy
    async function fetchWithCorsProxy(ipfsUrl, tokenId) {
        const corsProxies = [
            'https://api.allorigins.win/raw?url=',
            'https://corsproxy.io/?',
            'https://thingproxy.freeboard.io/fetch/'
        ];

        for (const proxy of corsProxies) {
            try {
                console.log(`Trying CORS proxy: ${proxy} for URL: ${ipfsUrl} (Token #${tokenId})`);
                const response = await fetch(`${proxy}${encodeURIComponent(ipfsUrl)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (response.ok) {
                    const data = await response.json();
                    if (data && data.name && data.description && data.image) {
                        console.log(`Successfully fetched with CORS proxy for Token #${tokenId}:`, data);
                        return data;
                    }
                } else {
                    console.warn(`Invalid response from ${proxy + ipfsUrl}: ${response.status}`);
                }
            } catch (error) {
                console.warn(`CORS proxy fetch failed for ${proxy + ipfsUrl} (Token #${tokenId}): ${error.message}`);
            }
        }
        console.error(`All CORS proxies failed for URL: ${ipfsUrl} (Token #${tokenId})`);
        return null;
    }

    // Fetch metadata from IPFS
    async function fetchMetadata(ipfsHash, tokenId) {
        if (!ipfsHash || !/^[a-zA-Z0-9]{46}$/.test(ipfsHash)) {
            console.error(`Invalid IPFS hash for Token #${tokenId}: ${ipfsHash}`);
            showToast(`Invalid metadata URI for Token #${tokenId}.`, 'error');
            return {
                name: `Token #${tokenId}`,
                description: 'Metadata unavailable',
                image: '/assets/nft_images/fallback.png',
                category: 'Unknown',
                isFallback: true
            };
        }

        const dedicatedGateway = `https://ipfs.io/ipfs/${ipfsHash}`;
        const pinataJwt = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySW5mb3JtYXRpb24iOnsiaWQiOiI1Mzg2ZDA2MS0zZmE2LTRiNDktOWY2YS0yOTQxNmJhZjRlODkiLCJlbWFpbCI6ImJvb2R5a2hhdHRhYjk3QGdtYWlsLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJwaW5fcG9saWN5Ijp7InJlZ2lvbnMiOlt7ImRlc2lyZWRSZXBsaWNhdGlvbkNvdW50IjoxLCJpZCI6IkZSQTEifSx7ImRlc2lyZWRSZXBsaWNhdGlvbkNvdW50IjoxLCJpZCI6Ik5ZQzEifV0sInZlcnNpb24iOjF9LCJtZmFfZW5hYmxlZCI6ZmFsc2UsInN0YXR1cyI6IkFDVElWRSJ9LCJhdXRoZW50aWNhdGlvblR5cGUiOiJzY29wZWRLZXkiLCJzY29wZWRLZXlLZXkiOiIyZTcwYTAzZWMzN2VmYjAzMjkxOCIsInNjb3BlZEtleVNlY3JldCI6IjdmY2FjOGQzNGQ1NDRmM2I1NmU3ZWQ4N2RjNmI2NzVjNzdiNWFlMGNmYmZmYjMwODc2YTljZjVhZDZjMmJlYTIiLCJleHAiOjE3NzgxNTY3OTh9.vtlL2PhURiGbusters6NKVTbsoKPkaUJJgIy67iTZwdkR6ig5M';
        const gateways = [
            `https://cloudflare-ipfs.com/ipfs/${ipfsHash}`,
            `https://ipfs.io/ipfs/${ipfsHash}`,
            `https://gateway.pinata.cloud/ipfs/${ipfsHash}`
        ];

        // Try CORS proxy
        const corsMetadata = await fetchWithCorsProxy(dedicatedGateway, tokenId);
        if (corsMetadata) {
            console.log(`Metadata fetched via CORS proxy for Token #${tokenId}`);
            return corsMetadata;
        }

        // Try dedicated Pinata gateway
        try {
            console.log(`Trying dedicated Pinata gateway for Token #${tokenId}: ${dedicatedGateway}`);
            const response = await axios.get(dedicatedGateway, {
                timeout: 10000,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${pinataJwt}`
                }
            });
            if (response.data && response.data.name && response.data.description && response.data.image) {
                console.log(`Successfully fetched metadata from dedicated gateway for Token #${tokenId}`);
                return response.data;
            }
        } catch (error) {
            console.warn(`Dedicated Pinata gateway failed for Token #${tokenId}: ${error.message}`);
        }

        // Try fallback gateways
        for (const gateway of gateways) {
            try {
                console.log(`Trying gateway for Token #${tokenId}: ${gateway}`);
                const response = await axios.get(gateway, {
                    timeout: 10000,
                    headers: { 'Accept': 'application/json' }
                });
                if (response.data && response.data.name && response.data.description && response.data.image) {
                    console.log(`Successfully fetched metadata from ${gateway} for Token #${tokenId}`);
                    return response.data;
                }
            } catch (error) {
                console.warn(`IPFS fetch failed for ${gateway} (Token #${tokenId}): ${error.message}`);
            }
        }

        // Fallback metadata
        console.warn(`All fetch attempts failed for Token #${tokenId}. Using fallback metadata.`);
        showToast(`Unable to load metadata for Token #${tokenId}.`, 'error');
        return {
            name: `Token #${tokenId}`,
            description: 'Metadata unavailable',
            image: '/assets/nft_images/fallback.png',
            category: 'Unknown',
            isFallback: true
        };
    }

    // Load NFTs
    async function loadNFTs() {
        showLoader();
        try {
            const initialized = await initWeb3();
            if (!initialized) {
                nftGrid.innerHTML = '<p class="text-gray-400 text-center col-span-4">Unable to load NFTs.</p>';
                return;
            }

            const userAddress = '{{ $fullAddress ?? '' }}'.toLowerCase();
            if (!userAddress) {
                showToast('User wallet address not found.', 'error');
                nftGrid.innerHTML = '<p class="text-gray-400 text-center col-span-4">Wallet address not found.</p>';
                return;
            }

            // Fetch listed NFTs (Created)
            listedNFTs = [];
            const listedTokens = await contract.getAllNFTs();
            for (const token of listedTokens) {
                if (token.seller.toLowerCase() === userAddress && token.currentlyListed) {
                    const tokenId = token.tokenId.toNumber();
                    const tokenURI = await contract.tokenURI(tokenId);
                    console.log(`Token URI for Token #${tokenId}: ${tokenURI}`);
                    if (!tokenURI || !tokenURI.startsWith('ipfs://')) {
                        console.warn(`Invalid tokenURI for Token #${tokenId}: ${tokenURI}`);
                        continue;
                    }
                    const ipfsHash = tokenURI.replace('ipfs://', '');
                    const metadata = await fetchMetadata(ipfsHash, tokenId);
                    listedNFTs.push({
                        tokenId,
                        name: metadata.name,
                        description: metadata.description,
                        image: metadata.image.startsWith('ipfs://') ? `https://ipfs.io/ipfs/${metadata.image.replace('ipfs://', '')}` : metadata.image,
                        price: ethers.utils.formatEther(token.price),
                        seller: token.seller,
                        category: metadata.category || 'Art',
                        isFallback: metadata.isFallback || false
                    });
                }
            }

            // Fetch owned NFTs
            ownedNFTs = [];
            const balance = await contract.balanceOf(userAddress);
            for (let i = 0; i < balance.toNumber(); i++) {
                const tokenId = await contract.tokenOfOwnerByIndex(userAddress, i);
                const tokenURI = await contract.tokenURI(tokenId);
                console.log(`Token URI for Token #${tokenId}: ${tokenURI}`);
                if (!tokenURI || !tokenURI.startsWith('ipfs://')) {
                    console.warn(`Invalid tokenURI for Token #${tokenId}: ${tokenURI}`);
                    continue;
                }
                const ipfsHash = tokenURI.replace('ipfs://', '');
                const metadata = await fetchMetadata(ipfsHash, tokenId);
                const tokenData = listedNFTs.find(nft => nft.tokenId === tokenId.toNumber()) || {
                    price: 'Not Listed',
                    seller: userAddress
                };
                ownedNFTs.push({
                    tokenId: tokenId.toNumber(),
                    name: metadata.name,
                    description: metadata.description,
                    image: metadata.image.startsWith('ipfs://') ? `https://ipfs.io/ipfs/${metadata.image.replace('ipfs://', '')}` : metadata.image,
                    price: tokenData.price,
                    seller: tokenData.seller,
                    category: metadata.category || 'Art',
                    isFallback: metadata.isFallback || false
                });
            }

            createdCount.textContent = listedNFTs.length;
            ownedCount.textContent = ownedNFTs.length;
            renderNFTs();
        } catch (error) {
            showToast(`Failed to fetch NFTs: ${error.message}`, 'error');
            nftGrid.innerHTML = '<p class="text-gray-400 text-center col-span-4">Error loading NFTs.</p>';
        } finally {
            hideLoader();
        }
    }

    // Render NFTs
    function renderNFTs() {
        const nfts = activeTab === 'created' ? listedNFTs : ownedNFTs;
        const start = (currentPage - 1) * perPage;
        const end = start + perPage;
        const nftsToShow = nfts.slice(start, end);

        nftGrid.innerHTML = '';
        if (nftsToShow.length === 0) {
            nftGrid.innerHTML = `<p class="text-gray-400 text-center col-span-4">No ${activeTab} NFTs found.</p>`;
            return;
        }

        nftsToShow.forEach((nft, index) => {
            const card = document.createElement('div');
            card.className = 'nft-card rounded-xl';
            card.style.animation = `fadeIn 0.5s ease-out forwards`;
            card.style.animationDelay = `${0.1 * (index + 1)}s`;
            card.innerHTML = `
                <div class="nft-img-container h-40">
                    <a href="/nft/nft-details/${nft.tokenId}">
                        <img src="${nft.image}" alt="${nft.name}" class="w-full h-full object-cover" onerror="this.src='/assets/nft_images/fallback.png'">
                    </a>
                    <span class="category-tag">${nft.category}</span>
                    <button class="favorite-btn" data-token-id="${nft.tokenId}">
                        <i class="fas fa-heart favorite-icon"></i>
                    </button>
                </div>
                <div class="nft-content">
                    <a href="/nft/nft-details/${nft.tokenId}">
                        <h3 class="nft-title">${nft.name}</h3>
                    </a>
                    <div class="nft-creator">
                        <div class="w-6 h-6 rounded-full overflow-hidden creator-badge">
                            <span class="text-xs">🛸</span>
                        </div>
                        <span class="creator-name">${nft.seller.slice(0, 6)}...${nft.seller.slice(-4)}</span>
                    </div>
                    <div class="nft-details">
                        <div>
                            <p class="price-label">Price</p>
                            <p class="price-value">${nft.price === 'Not Listed' ? 'Not Listed' : parseFloat(nft.price).toFixed(3) + ' ETH'}</p>
                        </div>
                        <div class="text-right">
                            <p class="bid-label">Highest Bid</p>
                            <p class="bid-value">N/A</p>
                        </div>
                    </div>
                    ${nft.price !== 'Not Listed' ? `<div class="buy-button" data-token-id="${nft.tokenId}">Buy Now</div>` : ''}
                </div>
            `;
            nftGrid.appendChild(card);
        });

        document.querySelector('.load-more-btn').style.display = end >= nfts.length ? 'none' : 'block';
    }

    // Load more NFTs
    window.loadMoreNFTs = function() {
        currentPage++;
        renderNFTs();
    };

    // Toggle favorite
    function toggleFavorite(tokenId) {
        showToast(`Favorite toggled for Token #${tokenId}`, 'success');
    }

    // Buy NFT
    async function buyNFT(tokenId) {
        if (!contract || !signer) {
            showToast('Wallet not connected.', 'error');
            return;
        }
        try {
            showLoader();
            const nft = listedNFTs.find(n => n.tokenId === tokenId);
            const price = ethers.utils.parseEther(nft.price);
            const tx = await contract.executeSale(tokenId, { value: price });
            await tx.wait();
            showToast(`Successfully purchased Token #${tokenId}!`, 'success');
            loadNFTs();
        } catch (error) {
            showToast(`Failed to purchase NFT: ${error.message}`, 'error');
        } finally {
            hideLoader();
        }
    }

    // Switch tabs
    function switchTab(tab) {
        activeTab = tab;
        currentPage = 1;
        createdTab.classList.toggle('tab-active', tab === 'created');
        ownedTab.classList.toggle('tab-active', tab === 'owned');
        collectionTab.classList.toggle('tab-active', tab === 'collection');
        if (tab === 'collection') {
            nftGrid.innerHTML = '<p class="text-gray-400 text-center col-span-4">This tab is not yet implemented.</p>';
        } else {
            renderNFTs();
        }
    }

    // Troubleshooting panel
    function showTroubleshootingPanel(message) {
        nftGrid.innerHTML = `
            <div class="troubleshooting-panel col-span-4">
                <h3>Unable to Connect to Blockchain</h3>
                <p>${message}</p>
                <p>Please try the following steps:</p>
                <ul>
                    <li>Ensure <a href="https://metamask.io/download/" target="_blank">MetaMask</a> is installed.</li>
                    <li>Switch MetaMask to Sepolia testnet (Chain ID: 11155111).</li>
                    <li>Allow MetaMask to connect when prompted.</li>
                    <li>Verify the contract at <a href="https://sepolia.etherscan.io/address/${web3Config.contractAddress}" target="_blank">${web3Config.contractAddress}</a>.</li>
                    <li>Refresh the page or try another browser.</li>
                </ul>
            </div>
        `;
    }

    // Copy wallet address
    function copyWalletAddress() {
        const address = '{{ $fullAddress ?? 'no address' }}';
        navigator.clipboard.writeText(address).then(() => {
            showToast('Wallet address copied to clipboard!', 'success');
        }, () => {
            showToast('Failed to copy address', 'error');
        });
    }

    // Parallax and counters
    const banner = document.getElementById('parallax-banner');
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY;
        if (banner) {
            banner.style.transform = `translateY(${scrolled * 0.25}px)`;
        }
    });
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        const updateCounter = () => {
            current += step;
            if (current < target) {
                counter.textContent = target > 1000 ? Math.floor(current).toLocaleString() + '+' : Math.floor(current) + '+';
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target > 1000 ? target.toLocaleString() + '+' : target + '+';
            }
        };
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                updateCounter();
                observer.disconnect();
            }
        });
        observer.observe(counter);
    });

    // Event listeners
    createdTab.addEventListener('click', (e) => { e.preventDefault(); switchTab('created'); });
    ownedTab.addEventListener('click', (e) => { e.preventDefault(); switchTab('owned'); });
    collectionTab.addEventListener('click', (e) => { e.preventDefault(); switchTab('collection'); });
    copyAddressBtn.addEventListener('click', copyWalletAddress);
    nftGrid.addEventListener('click', (e) => {
        const favoriteBtn = e.target.closest('.favorite-btn');
        const buyBtn = e.target.closest('.buy-button');
        if (favoriteBtn) {
            const tokenId = parseInt(favoriteBtn.dataset.tokenId);
            toggleFavorite(tokenId);
        } else if (buyBtn) {
            const tokenId = parseInt(buyBtn.dataset.tokenId);
            buyNFT(tokenId);
        }
    });
    document.addEventListener('click', (e) => {
        const toastCloseBtn = e.target.closest('.toast-close-btn');
        if (toastCloseBtn) {
            toastCloseBtn.parentElement.remove();
        }
    });

    // Initial load
    loadNFTs();

    // Particle effect
    function createParticles() {
        if (!document.getElementById('particles-js')) {
            console.warn('Particle container #particles-js not found.');
            return;
        }
        console.log('Creating particles on #particles-js');
        // Actual createParticles implementation needed here
    }
    try {
        createParticles();
    } catch (error) {
        console.error('Failed to initialize particles:', error);
    }
});
</script>
@endpush

@section('content')
<div class="bg-gray-900 text-white min-h-screen">
    <!-- Banner -->
    <div class="w-full relative overflow-hidden gradient-bg" id="banner-container">
        <img src="{{ $profile->backgroundUrl() }}" alt="Banner" class="w-full banner-img" id="parallax-banner">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-purple-700/40 to-purple-900/80"></div>
    </div>

    <!-- Profile Header -->
    <div class="container mx-auto px-4 -mt-16 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8">
            <div class="flex items-end fade-in fade-in-1">
                <div class="w-32 h-32 rounded-xl overflow-hidden border-4 border-gray-900 bg-gray-800 avatar-glow">
                    <img src="{{ $profile->avatarUrl() }}" alt="Profile Avatar" class="w-full h-full object-cover">
                </div>
                <div class="ml-4 mb-2">
                    <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                    <div class="flex items-center mt-2">
                        <div 
                            id="copy-address-btn"
                            class="bg-purple-600 text-white text-sm px-4 py-2 rounded-lg flex items-center cursor-pointer hover-scale"
                            title="Click to copy full wallet address"
                        >
                            <span class="mr-2">{{ $shortAddress ?? '' }}</span>
                            <i class="fas fa-copy h-4 w-4"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-4 fade-in fade-in-2">
                <button class="border border-purple-600 text-white px-6 py-3 rounded-lg flex items-center hover:bg-purple-600 transition duration-300 pulse-btn">
                    <i class="fas fa-plus h-5 w-5 mr-2"></i>
                    Follow
                </button>
            </div>
        </div>

        <!-- Profile Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-800 rounded-xl p-6 hover-scale fade-in fade-in-1">
                <div class="text-3xl font-bold counter" data-target="250000">0</div>
                <div class="text-gray-400">Volume</div>
            </div>
            <div class="bg-gray-800 rounded-xl p-6 hover-scale fade-in fade-in-2">
                <div class="text-3xl font-bold counter" data-target="50">0</div>
                <div class="text-gray-400">NFTs Sold</div>
            </div>
            <div class="bg-gray-800 rounded-xl p-6 hover-scale fade-in fade-in-3">
                <div class="text-3xl font-bold counter" data-target="3000">0</div>
                <div class="text-gray-400">Followers</div>
            </div>
        </div>

        <!-- Profile Bio -->
        <div class="mb-8 fade-in fade-in-1">
            <h2 class="text-2xl font-bold mb-4">Bio</h2>
            <p class="text-gray-300">{{ $profile->bio ?? '' }}</p>
        </div>

        <!-- Profile Links -->
        <div class="mb-8 fade-in fade-in-2">
            <h2 class="text-2xl font-bold mb-4">Links</h2>
            <div class="flex space-x-6">
                <a href="{{ $profile->twitter ?? '#' }}" class="text-gray-400 hover:text-white transition transform hover:scale-110 duration-300">
                    <i class="fab fa-twitter h-6 w-6"></i>
                </a>
                <a href="{{ $profile->instagram ?? '#' }}" class="text-gray-400 hover:text-white transition transform hover:scale-110 duration-300">
                    <i class="fab fa-instagram h-6 w-6"></i>
                </a>
                <a href="{{ $profile->personal_website ?? '#' }}" class="text-gray-400 hover:text-white transition transform hover:scale-110 duration-300">
                    <i class="fas fa-globe h-6 w-6"></i>
                </a>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="flex border-b border-gray-700 mb-8 justify-center fade-in fade-in-3">
            <nav class="flex space-x-8">
                <a href="#" id="created-tab" class="tab-active text-white px-4 py-4 font-medium">
                    Created <span class="ml-2 bg-gray-700 px-2 py-1 rounded-lg text-sm" id="created-count">0</span>
                </a>
                <a href="#" id="owned-tab" class="text-gray-400 hover:text-white px-4 py-4 font-medium tab-hover">
                    Owned <span class="ml-2 bg-gray-700 px-2 py-1 rounded-lg text-sm" id="owned-count">0</span>
                </a>
                <a href="#" id="collection-tab" class="text-gray-400 hover:text-white px-4 py-4 font-medium tab-hover">
                    Collection <span class="ml-2 bg-gray-700 px-2 py-1 rounded-lg text-sm">4</span>
                </a>
            </nav>
        </div>

        <!-- NFT Gallery Grid -->
        <div class="max-w-6xl mx-auto relative fade-in fade-in-4">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6" id="nft-grid"></div>
            <div class="loader-overlay" id="loader-overlay">
                <div class="text-center">
                    <div class="loader"></div>
                    <p class="loader-text">Loading NFTs...</p>
                </div>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="flex justify-center mb-12 fade-in fade-in-4">
            <button class="bg-gray-800 text-white px-8 py-4 rounded-lg flex items-center hover:bg-purple-700 transition duration-300 hover-scale load-more-btn">
                <i class="fas fa-chevron-down h-5 w-5 mr-2"></i>
                Load More
            </button>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast-container"></div>
</div>
@endsection
