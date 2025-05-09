@extends('layouts.layout')

@section('title', 'NFT Marketplace')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    /* Custom Keyframes & Animations */
    @keyframes card-glow {
        0%, 100% { box-shadow: 0 0 12px rgba(162, 89, 255, 0.3), 0 0 18px rgba(142, 66, 245, 0.2); }
        50% { box-shadow: 0 0 18px rgba(162, 89, 255, 0.5), 0 0 28px rgba(142, 66, 245, 0.4); }
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse-light {
        0%, 100% { opacity: 0.8; }
        50% { opacity: 1; }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Page Styles */
    .page-bg {
        background: linear-gradient(180deg, #1a1a1a 0%, #121212 100%);
        background-attachment: fixed;
    }
    
    /* Spinner Styles */
    .loader-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(18, 18, 18, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: 12px;
        transition: opacity 0.3s ease;
    }
    .loader {
        border: 4px solid rgba(162, 89, 255, 0.2);
        border-top: 4px solid #a259ff;
        border-radius: 50%;
        width: 48px;
        height: 48px;
        animation: spin 1s linear infinite;
    }
    .loader-text {
        color: #bd83ff;
        font-size: 0.9rem;
        margin-top: 12px;
        animation: pulse-light 1.5s ease-in-out infinite;
    }
    
    /* Enhanced Search Bar */
    .search-wrapper {
        position: relative;
        transition: all 0.3s ease;
        overflow: hidden;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    .search-input {
        background: rgba(31, 29, 43, 0.6);
        border: 1px solid #a259ff;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        padding-right: 80px;
    }
    .search-input:focus {
        background: rgba(36, 34, 50, 0.8);
        box-shadow: 0 0 20px rgba(162, 89, 255, 0.5);
        border-color: #bd83ff;
    }
    .search-buttons {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        gap: 10px;
    }
    .search-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(162, 89, 255, 0.15);
        border-radius: 8px;
        width: 32px;
        height: 32px;
        transition: all 0.2s ease;
    }
    .search-btn:hover {
        background: rgba(162, 89, 255, 0.3);
        transform: scale(1.05);
    }
    
    /* Filter Panel Styling */
    .filter-panel {
        background: rgba(25, 23, 36, 0.8);
        border: 1px solid rgba(162, 89, 255, 0.2);
        backdrop-filter: blur(8px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        transform: translateY(0);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    /* Filter Buttons */
    .filter-btn {
        background: linear-gradient(45deg, #2a2a2a, #3a3a3a);
        transition: all 0.3s ease;
        border: 1px solid rgba(162, 89, 255, 0.2);
        position: relative;
        overflow: hidden;
    }
    .filter-btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: all 0.5s ease;
    }
    .filter-btn:hover:before {
        left: 100%;
    }
    .filter-btn:hover, .filter-btn.active {
        background: linear-gradient(45deg, #a259ff, #7b45e7);
        border-color: #a259ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(123, 69, 231, 0.3);
    }
    .filter-btn.active {
        position: relative;
    }
    .filter-btn.active:after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 50%;
        width: 20px;
        height: 3px;
        background: #bd83ff;
        border-radius: 3px;
        transform: translateX(-50%);
    }
    
    /* Price Range Slider */
    .price-slider-container {
        padding: 0 10px;
        margin-top: 8px;
    }
    .price-slider {
        -webkit-appearance: none;
        height: 6px;
        background: linear-gradient(90deg, #2a2a2a, #3a3a3a);
        border-radius: 6px;
        outline: none;
        margin: 10px 0;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3);
    }
    .price-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: linear-gradient(135deg, #a259ff, #7b45e7);
        cursor: pointer;
        transition: all 0.2s ease;
        border: 2px solid #1a1a1a;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }
    .price-slider::-webkit-slider-thumb:hover {
        transform: scale(1.15);
        box-shadow: 0 0 12px rgba(162, 89, 255, 0.6);
    }
    .price-values {
        display: flex;
        justify-content: space-between;
        color: #a0a0a0;
        font-size: 0.75rem;
        margin-top: -5px;
    }
    .price-current {
        color: #bd83ff;
        font-weight: bold;
    }
    
    /* Sort Dropdown */
    .sort-select {
        background: rgba(31, 29, 43, 0.6);
        border: 1px solid rgba(162, 89, 255, 0.3);
        color: white;
        border-radius: 8px;
        padding: 8px 12px;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23a259ff' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: calc(100% - 12px) center;
        padding-right: 32px;
        transition: all 0.3s ease;
    }
    .sort-select:focus {
        border-color: #a259ff;
        box-shadow: 0 0 0 2px rgba(162, 89, 255, 0.25);
        outline: none;
    }
    
    /* Stats Section */
    .stats-section {
        background: rgba(31, 29, 43, 0.6);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(162, 89, 255, 0.2);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    .stats-section:hover {
        border-color: rgba(162, 89, 255, 0.4);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }
    .stats-item {
        position: relative;
        padding-right: 18px;
    }
    .stats-item:not(:last-child):after {
        content: '';
        position: absolute;
        right: 6px;
        top: 50%;
        transform: translateY(-50%);
        height: 15px;
        width: 1px;
        background: rgba(162, 89, 255, 0.3);
    }
    .stats-value {
        font-weight: 600;
        color: #bd83ff;
        transition: all 0.3s ease;
    }
    .stats-section:hover .stats-value {
        color: #d4b0ff;
    }
    
    /* NFT Card Styles */
    .nft-card {
        background: rgba(31, 29, 43, 0.6);
        backdrop-filter: blur(5px);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(162, 89, 255, 0.1);
        position: relative;
        overflow: hidden;
        height: 100%;
        transform: translateZ(0);
        backface-visibility: hidden;
        perspective: 1000px;
    }
    .nft-card:hover {
        transform: translateY(-8px) scale(1.02);
        animation: card-glow 2s infinite;
        border-color: rgba(162, 89, 255, 0.5);
        z-index: 1;
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
        position: relative;
        display: inline-block;
    }
    .nft-card:hover .nft-title {
        color: #d4b0ff;
    }
    .nft-creator {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .creator-badge {
        background: linear-gradient(45deg, #a259ff, #7b45e7);
        border: 2px solid #1a1a1a;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    .nft-card:hover .creator-badge {
        transform: scale(1.1);
        box-shadow: 0 0 8px rgba(162, 89, 255, 0.5);
    }
    .creator-name {
        color: #a0a0a0;
        font-size: 0.75rem;
        transition: all 0.3s ease;
        margin-left: 8px;
    }
    .nft-card:hover .creator-name {
        color: #d4b0ff;
    }
    .nft-details {
        display: flex;
        justify-content: space-between;
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid rgba(162, 89, 255, 0.1);
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
    .nft-card:hover .price-value {
        color: white;
    }
    .nft-card:hover .bid-value {
        color: #d4b0ff;
    }
    
    /* Category Tag */
    .category-tag {
        background: rgba(162, 89, 255, 0.15);
        border: 1px solid rgba(162, 89, 255, 0.3);
        transition: all 0.3s ease;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.65rem;
        color: #d4b0ff;
        position: absolute;
        top: 8px;
        left: 8px;
        z-index: 2;
        backdrop-filter: blur(4px);
    }
    .nft-card:hover .category-tag {
        background: rgba(162, 89, 255, 0.3);
        box-shadow: 0 0 8px rgba(162, 89, 255, 0.3);
    }
    
    /* Buy Now Button */
    .buy-button {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(90deg, #a259ff, #7b45e7);
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
    
    /* Favorite Button */
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
        border: 1px solid rgba(162, 89, 255, 0.3);
        backdrop-filter: blur(4px);
        transform: scale(0.8);
        opacity: 0;
        transition: all 0.3s ease;
    }
    .nft-card:hover .favorite-btn {
        opacity: 1;
        transform: scale(1);
    }
    .favorite-btn:hover {
        background: rgba(162, 89, 255, 0.3);
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
    
    /* Loading Animation for Grid */
    .grid-loading {
        animation: fadeIn 0.8s ease-out forwards;
    }
    
    /* Empty State & Load More */
    .load-more-btn {
        background: linear-gradient(45deg, #2a2a2a, #3a3a3a);
        border: 1px solid rgba(162, 89, 255, 0.3);
        color: white;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .load-more-btn:hover {
        background: linear-gradient(45deg, #a259ff, #7b45e7);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(123, 69, 231, 0.3);
    }
    
    /* Error Message */
    .error-message {
        color: #ff5555;
        font-size: 0.75rem;
        text-align: center;
        margin-top: 4px;
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
        color: #d4b0ff;
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
    
    /* Responsive breakpoints */
    @media (max-width: 768px) {
        .nft-card {
            max-width: none;
        }
        .stats-item {
            margin-bottom: 8px;
        }
        .stats-item:after {
            display: none;
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
@endpush

@section('content')
<div class="min-h-screen page-bg py-12 px-4 sm:px-6 lg:px-8">
    <!-- Marketplace Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-500 mb-3" style="animation: fadeIn 0.8s ease-out forwards;">NFT Marketplace</h1>
        <p class="text-gray-400 max-w-2xl mx-auto" style="animation: fadeIn 1s ease-out forwards;">Discover, collect, and sell extraordinary NFTs from top creators and collections.</p>
    </div>

    <!-- Advanced Search & Filter Section -->
    <div class="max-w-6xl mx-auto mb-10" style="animation: fadeIn 1.2s ease-out forwards;">
        <div class="filter-panel rounded-xl p-6">
            <!-- Search Bar -->
            <div class="search-wrapper mb-6">
                <input 
                    type="text" 
                    id="search-input"
                    placeholder="Search NFTs, collections, or creators" 
                    class="search-input w-full py-3 px-5 text-white rounded-lg focus:outline-none"
                >
                <div class="search-buttons">
                    <button class="search-btn text-purple-300 hover:text-purple-100" onclick="searchNFTs()">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    <button class="search-btn text-purple-300 hover:text-purple-100" onclick="clearSearch()">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Filter Options -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Categories Filter -->
                <div>
                    <h3 class="text-white font-medium mb-3">Categories</h3>
                    <div class="flex flex-wrap gap-2">
                        <button class="filter-btn text-xs px-3 py-2 rounded-lg text-white active" data-category="all">All</button>
                        <button class="filter-btn text-xs px-3 py-2 rounded-lg text-white" data-category="Art">Art</button>
                        <button class="filter-btn text-xs px-3 py-2 rounded-lg text-white" data-category="Collectibles">Collectibles</button>
                        <button class="filter-btn text-xs px-3 py-2 rounded-lg text-white" data-category="Music">Music</button>
                        <button class="filter-btn text-xs px-3 py-2 rounded-lg text-white" data-category="Photography">Photography</button>
                        <button class="filter-btn text-xs px-3 py-2 rounded-lg text-white" data-category="Gaming">Gaming</button>
                    </div>
                </div>
                
                <!-- Price Range Filter -->
                <div>
                    <h3 class="text-white font-medium mb-3">Price Range</h3>
                    <div class="price-slider-container">
                        <input type="range" min="0" max="5" step="0.1" value="2.5" class="price-slider w-full" id="price-slider">
                        <div class="price-values">
                            <span>0 ETH</span>
                            <span class="price-current" id="price-value">2.5 ETH</span>
                            <span>5+ ETH</span>
                        </div>
                    </div>
                </div>
                
                <!-- Sort By Options -->
                <div>
                    <h3 class="text-white font-medium mb-3">Sort By</h3>
                    <select class="sort-select w-full focus:outline-none" id="sort-select">
                        <option value="recent">Recently Added</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="popular">Most Popular</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- NFT Collection Stats -->
    <div class="max-w-6xl mx-auto mb-8">
        <div class="stats-section flex flex-wrap justify-between items-center px-6 py-4">
            <div class="flex flex-wrap items-center space-x-4" id="stats-items">
                <div class="stats-item">
                    <span class="text-white font-medium">NFTs</span>
                    <span class="ml-2 stats-value" id="nft-count">0</span>
                </div>
                <div class="stats-item">
                    <span class="text-white font-medium">Collections</span>
                    <span class="ml-2 stats-value">1</span>
                </div>
                <div class="stats-item">
                    <span class="text-white font-medium">Volume</span>
                    <span class="ml-2 stats-value">0 ETH</span>
                </div>
            </div>
            <div class="text-gray-400 text-sm" id="stats-showing">
                Showing <span class="text-white" id="showing-count">0</span> of <span class="text-white" id="total-count">0</span> NFTs
            </div>
        </div>
    </div>

    <!-- NFT Grid -->
    <div class="max-w-6xl mx-auto">
        <div class="relative">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 grid-loading" id="nft-grid">
                <!-- Dynamic NFTs will be populated here -->
            </div>
            <div class="loader-overlay" id="loader-overlay">
                <div class="text-center">
                    <div class="loader"></div>
                    <p class="loader-text">Loading NFTs...</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-8">
            <button class="load-more-btn" onclick="loadMoreNFTs()">Load More</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    // Check if ethers.js loaded
    if (!window.ethers) {
        console.error('Ethers.js failed to load.');
        showStatus('Failed to load blockchain library. Please refresh the page or check your network.', 'error');
        document.getElementById('nft-grid').innerHTML = '<p class="text-gray-400 text-center col-span-4">Unable to load NFTs due to missing library.</p>';
        document.getElementById('loader-overlay').style.display = 'none';
        return;
    }

    // Initialize Axios with CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!csrfToken) {
        console.error('CSRF token not found.');
        showStatus('Authentication setup failed.', 'error');
        document.getElementById('nft-grid').innerHTML = '<p class="text-gray-400 text-center col-span-4">Authentication setup failed.</p>';
        document.getElementById('loader-overlay').style.display = 'none';
        return;
    }
    await axios.get('/sanctum/csrf-cookie');
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

    // Web3 configuration
    const web3Config = @json($web3Config ?? [
        'contractAddress' => '0x636937bac8A853767CF2422D4eDcCd2CC9e190d0',
        'contractABI' => [] // Replace with actual ABI
    ]);
    if (!web3Config.contractAddress || !web3Config.contractABI.length) {
        console.error('Invalid web3Config:', web3Config);
        showStatus('Blockchain configuration missing.', 'error');
        document.getElementById('nft-grid').innerHTML = '<p class="text-gray-400 text-center col-span-4">Blockchain configuration missing.</p>';
        document.getElementById('loader-overlay').style.display = 'none';
        return;
    }

    let provider, signer, contract;
    let nfts = [];
    let filteredNFTs = [];
    let currentPage = 1;
    const perPage = 12;

    // DOM elements
    const nftGrid = document.getElementById('nft-grid');
    const loaderOverlay = document.getElementById('loader-overlay');
    const searchInput = document.getElementById('search-input');
    const priceSlider = document.getElementById('price-slider');
    const priceValue = document.getElementById('price-value');
    const sortSelect = document.getElementById('sort-select');
    const nftCount = document.getElementById('nft-count');
    const showingCount = document.getElementById('showing-count');
    const totalCount = document.getElementById('total-count');

    // Show/hide loader
    function showLoader() {
        loaderOverlay.style.display = 'flex';
        loaderOverlay.style.opacity = '1';
    }

    function hideLoader() {
        loaderOverlay.style.opacity = '0';
        setTimeout(() => {
            loaderOverlay.style.display = 'none';
        }, 300);
    }

    // Show status alert
    function showStatus(message, type) {
        const statusAlert = document.createElement('div');
        statusAlert.className = `status-alert ${type} fixed top-4 right-4 p-4 rounded-lg`;
        statusAlert.style.background = type === 'success' ? 'rgba(0, 200, 83, 0.2)' : type === 'warning' ? 'rgba(255, 193, 7, 0.2)' : 'rgba(255, 85, 85, 0.2)';
        statusAlert.style.border = type === 'success' ? '1px solid #00c853' : type === 'warning' ? '1px solid #ffc107' : '1px solid #ff5555';
        statusAlert.style.color = type === 'success' ? '#00c853' : type === 'warning' ? '#ffc107' : '#ff5555';
        statusAlert.textContent = message;
        document.body.appendChild(statusAlert);
        setTimeout(() => {
            statusAlert.remove();
        }, 5000);
    }

    // Display troubleshooting panel
    function showTroubleshootingPanel(message) {
        nftGrid.innerHTML = `
            <div class="troubleshooting-panel col-span-4">
                <h3>Unable to Connect to Blockchain</h3>
                <p>${message}</p>
                <p>Please try the following steps:</p>
                <ul>
                    <li>Ensure <a href="https://metamask.io/download/" target="_blank">MetaMask</a> is installed in your browser.</li>
                    <li>Switch MetaMask to the Sepolia testnet (Chain ID: 11155111).</li>
                    <li>Allow MetaMask to connect when prompted.</li>
                    <li>Verify the contract is deployed on Sepolia at <a href="https://sepolia.etherscan.io/address/${web3Config.contractAddress}" target="_blank">${web3Config.contractAddress}</a>.</li>
                    <li>Refresh the page or try a different browser.</li>
                </ul>
            </div>
        `;
    }

    // Initialize Web3 with retry
    async function initWeb3(maxRetries = 3, retryDelay = 1000) {
        for (let attempt = 1; attempt <= maxRetries; attempt++) {
            try {
                console.log(`Attempting Web3 initialization (Attempt ${attempt}/${maxRetries})...`);
                if (!window.ethers) {
                    throw new Error('Ethers.js not loaded.');
                }
                if (!window.ethereum) {
                    console.error('MetaMask not detected.');
                    showStatus('MetaMask is not installed.', 'error');
                    showTroubleshootingPanel('MetaMask is not installed in your browser.');
                    return false;
                }

                provider = new ethers.providers.Web3Provider(window.ethereum);
                console.log('Requesting MetaMask accounts...');
                await provider.send("eth_requestAccounts", []);
                const network = await provider.getNetwork();
                const expectedChainId = 11155111; // Sepolia chain ID
                console.log(`Connected to network: ${network.name} (Chain ID: ${network.chainId})`);
                if (network.chainId !== expectedChainId) {
                    console.error(`Wrong network. Expected Chain ID: ${expectedChainId}, Got: ${network.chainId}`);
                    showStatus(`Please switch MetaMask to the Sepolia network (Chain ID: ${expectedChainId}).`, 'error');
                    showTroubleshootingPanel(`MetaMask is connected to the wrong network (Chain ID: ${network.chainId}).`);
                    return false;
                }

                signer = provider.getSigner();
                contract = new ethers.Contract(
                    web3Config.contractAddress,
                    web3Config.contractABI,
                    signer
                );

                // Verify contract exists
                console.log(`Checking contract at ${web3Config.contractAddress}...`);
                const code = await provider.getCode(web3Config.contractAddress);
                if (code === '0x') {
                    console.error('No contract found at specified address.');
                    showStatus('Contract not found at the specified address.', 'error');
                    showTroubleshootingPanel(`No contract is deployed at ${web3Config.contractAddress} on Sepolia.`);
                    return false;
                }

                console.log('Web3 initialized successfully:', {
                    contractAddress: web3Config.contractAddress,
                    network: network.name,
                    chainId: network.chainId
                });
                return true;
            } catch (error) {
                console.error(`Web3 initialization failed (Attempt ${attempt}/${maxRetries}):`, {
                    message: error.message,
                    code: error.code,
                    stack: error.stack
                });
                if (attempt < maxRetries) {
                    console.log(`Retrying after ${retryDelay}ms...`);
                    await new Promise(resolve => setTimeout(resolve, retryDelay));
                    continue;
                }
                showStatus(`Failed to connect to blockchain: ${error.message}`, 'error');
                showTroubleshootingPanel(`Unable to connect to blockchain: ${error.message}`);
                return false;
            }
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
                    headers: {
                        'Accept': 'application/json'
                    }
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
    async function fetchMetadata(ipfsHash, tokenId) {
        const dedicatedGateway = `https://ipfs.io/ipfs/${ipfsHash}`;
        const pinataJwt = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySW5mb3JtYXRpb24iOnsiaWQiOiI1Mzg2ZDA2MS0zZmE2LTRiNDktOWY2YS0yOTQxNmJhZjRlODkiLCJlbWFpbCI6ImJvb2R5a2hhdHRhYjk3QGdtYWlsLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJwaW5fcG9saWN5Ijp7InJlZ2lvbnMiOlt7ImRlc2lyZWRSZXBsaWNhdGlvbkNvdW50IjoxLCJpZCI6IkZSQTEifSx7ImRlc2lyZWRSZXBsaWNhdGlvbkNvdW50IjoxLCJpZCI6Ik5ZQzEifV0sInZlcnNpb24iOjF9LCJtZmFfZW5hYmxlZCI6ZmFsc2UsInN0YXR1cyI6IkFDVElWRSJ9LCJhdXRoZW50aWNhdGlvblR5cGUiOiJzY29wZWRLZXkiLCJzY29wZWRLZXlLZXkiOiIyZTcwYTAzZWMzN2VmYjAzMjkxOCIsInNjb3BlZEtleVNlY3JldCI6IjdmY2FjOGQzNGQ1NDRmM2I1NmU3ZWQ4N2RjNmI2NzVjNzdiNWFlMGNmYmZmYjMwODc2YTljZjVhZDZjMmJlYTIiLCJleHAiOjE3NzgxNTY3OTh9.vtlL2PhURiG6NKVTbsoKPkaUJJgIy67iTZwdkR6ig5M';

        // Try CORS proxy
        const corsMetadata = await fetchWithCorsProxy(dedicatedGateway);
        if (corsMetadata) {
            console.log(`Metadata fetched via CORS proxy for token ${tokenId}`);
            return corsMetadata;
        }

        // Try dedicated Pinata gateway
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

        // Fallback metadata
        console.warn(`All fetch attempts failed for token ${tokenId}. Using fallback metadata.`);
        showStatus(`Unable to load metadata for Token #${tokenId}.`, 'warning');
        return {
            name: `Token #${tokenId}`,
            description: "Metadata unavailable",
            image: "https://via.placeholder.com/400x400?text=NFT+Image",
            category: "Unknown",
            isFallback: true
        };
    }

    // Fetch and display NFTs
    async function loadNFTs() {
        showLoader();
        const startTime = Date.now();
        const minDisplayTime = 500;

        try {
            const initialized = await initWeb3();
            if (!initialized) {
                return;
            }

            console.log('Fetching listed NFTs...');
            let listedTokens = [];
            try {
                listedTokens = await contract.getAllNFTs();
            } catch (error) {
                console.error('Contract call to getAllNFTs failed:', error);
                showStatus('Failed to fetch NFTs: Contract call reverted. Check contract ABI or state.', 'error');
                nftGrid.innerHTML = '<p class="text-gray-400 text-center col-span-4">No NFTs available. Contract call failed.</p>';
                return;
            }

            console.log('Listed tokens:', listedTokens.map(token => ({
                tokenId: token.tokenId.toNumber(),
                seller: token.seller,
                price: ethers.utils.formatEther(token.price),
                owner: token.owner,
                currentlyListed: token.currentlyListed
            })));
            nfts = [];

            for (const token of listedTokens) {
                const tokenId = token.tokenId.toNumber();
                try {
                    console.log(`Processing token ID: ${tokenId}`);
                    const tokenURI = await contract.tokenURI(tokenId);
                    console.log(`Token URI for token ${tokenId}: ${tokenURI}`);
                    if (!tokenURI || !tokenURI.startsWith('ipfs://')) {
                        console.warn(`Invalid or empty tokenURI for token ${tokenId}: ${tokenURI}`);
                        showStatus(`Invalid metadata URI for Token #${tokenId}.`, 'error');
                        continue;
                    }

                    const ipfsHash = tokenURI.replace('ipfs://', '');
                    const metadata = await fetchMetadata(ipfsHash, tokenId);
                    if (!metadata) {
                        console.warn(`Skipping token ${tokenId} due to invalid metadata`);
                        continue;
                    }

                    console.log(`Metadata for token ${tokenId}:`, metadata);
                    nfts.push({
                        tokenId: tokenId,
                        name: metadata.name,
                        description: metadata.description,
                        image: metadata.image.startsWith('ipfs://') 
                            ? `https://ipfs.io/ipfs/${metadata.image.replace('ipfs://', '')}`
                            : metadata.image,
                        price: ethers.utils.formatEther(token.price),
                        seller: token.seller,
                        category: metadata.category || 'Art',
                        isFallback: metadata.isFallback || false
                    });
                } catch (error) {
                    console.error(`Error processing token ${tokenId}:`, {
                        message: error.message,
                        stack: error.stack,
                        code: error.code
                    });
                    showStatus(`Failed to load Token #${tokenId}: ${error.message}`, 'error');
                }
            }

            console.log('Processed NFTs:', nfts);
            if (nfts.length === 0) {
                nftGrid.innerHTML = '<p class="text-gray-400 text-center col-span-4">No NFTs available.</p>';
                showStatus('No valid NFTs found.', 'warning');
            }
            updateStats();
            filterAndRenderNFTs();
        } catch (error) {
            console.error('Error loading NFTs:', {                message: error.message,
                stack: error.stack,
                code: error.code
            });
            showStatus(`Failed to fetch NFTs: ${error.message}`, 'error');
            nftGrid.innerHTML = '<p class="text-gray-400 text-center col-span-4">Error loading NFTs.</p>';
        } finally {
            const elapsedTime = Date.now() - startTime;
            if (elapsedTime < minDisplayTime) {
                setTimeout(hideLoader, minDisplayTime - elapsedTime);
            } else {
                hideLoader();
            }
        }
    }

    // Update stats
    function updateStats() {
        nftCount.textContent = nfts.length;
        totalCount.textContent = filteredNFTs.length;
        showingCount.textContent = Math.min(currentPage * perPage, filteredNFTs.length);
    }

    // Filter and render NFTs
    function filterAndRenderNFTs() {
        const searchQuery = searchInput.value.toLowerCase().trim();
        const selectedCategory = document.querySelector('.filter-btn.active')?.dataset.category || 'all';
        const maxPrice = parseFloat(priceSlider.value);
        const sortOption = sortSelect.value;

        filteredNFTs = nfts.filter(nft => {
            const matchesSearch = nft.name.toLowerCase().includes(searchQuery) ||
                                 nft.description.toLowerCase().includes(searchQuery) ||
                                 nft.seller.toLowerCase().includes(searchQuery);
            const matchesCategory = selectedCategory === 'all' || nft.category === selectedCategory;
            const matchesPrice = parseFloat(nft.price) <= maxPrice || maxPrice >= 5;
            return matchesSearch && matchesCategory && matchesPrice;
        });

        // Sort NFTs
        filteredNFTs.sort((a, b) => {
            if (sortOption === 'price-low') {
                return parseFloat(a.price) - parseFloat(b.price);
            } else if (sortOption === 'price-high') {
                return parseFloat(b.price) - parseFloat(a.price);
            } else if (sortOption === 'recent') {
                return b.tokenId - a.tokenId; // Higher tokenId is more recent
            } else if (sortOption === 'popular') {
                return (b.views || 0) - (a.views || 0); // Placeholder for popularity
            }
            return 0;
        });

        currentPage = 1;
        renderNFTs();
        updateStats();
    }

    // Render NFTs for current page
    function renderNFTs() {
        const start = (currentPage - 1) * perPage;
        const end = start + perPage;
        const nftsToShow = filteredNFTs.slice(start, end);

        nftGrid.innerHTML = '';
        if (nftsToShow.length === 0) {
            nftGrid.innerHTML = '<p class="text-gray-400 text-center col-span-4">No NFTs match your filters.</p>';
            return;
        }

        nftsToShow.forEach(nft => {
            const card = document.createElement('div');
            card.className = 'nft-card rounded-lg';
            card.innerHTML = `
                <div class="nft-img-container relative pb-[100%]">
                    <a href="/nft/nft-details/${nft.tokenId}">
                        <img src="${nft.image}" alt="${nft.name}" class="absolute inset-0 w-full h-full object-contain p-2">
                    </a>
                    <span class="category-tag">${nft.category}</span>
                    <button class="favorite-btn" onclick="toggleFavorite(${nft.tokenId}, event)">
                        <i class="fas fa-heart favorite-icon"></i>
                    </button>
                </div>
                <div class="nft-content">
                    <a href="/nft/nft-details/${nft.tokenId}">
                        <h3 class="nft-title">${nft.name}</h3>
                    </a>
                    <div class="nft-creator">
                        <div class="creator-badge w-5 h-5 rounded-full flex items-center justify-center">
                            <span class="text-xs">🛸</span>
                        </div>
                        <span class="creator-name">${nft.seller.slice(0, 6)}...${nft.seller.slice(-4)}</span>
                    </div>
                    <div class="nft-details">
                        <div>
                            <p class="price-label">Price</p>
                            <p class="price-value">${parseFloat(nft.price).toFixed(3)} ETH</p>
                        </div>
                        <div class="text-right">
                            <p class="bid-label">Highest Bid</p>
                            <p class="bid-value">N/A</p>
                        </div>
                    </div>
                    <div class="buy-button" onclick="buyNFT(${nft.tokenId})">Buy Now</div>
                </div>
            `;
            nftGrid.appendChild(card);
        });

        // Update load more button visibility
        document.querySelector('.load-more-btn').style.display = end >= filteredNFTs.length ? 'none' : 'block';
    }

    // Load more NFTs
    window.loadMoreNFTs = function() {
        currentPage++;
        renderNFTs();
        updateStats();
    };

    // Search NFTs
    window.searchNFTs = function() {
        filterAndRenderNFTs();
    };

    // Clear search
    window.clearSearch = function() {
        searchInput.value = '';
        filterAndRenderNFTs();
    };

    // Toggle favorite
    window.toggleFavorite = function(tokenId, event) {
        event.stopPropagation();
        showStatus(`Favorite toggled for Token #${tokenId}`, 'success');
        // Implement favorite logic (e.g., localStorage or backend API)
    };

    // Buy NFT
    window.buyNFT = async function(tokenId) {
        if (!contract || !signer) {
            showStatus('Wallet not connected. Please connect MetaMask.', 'error');
            return;
        }

        try {
            showLoader();
            const token = nfts.find(nft => nft.tokenId === tokenId);
            if (!token) {
                showStatus('NFT not found.', 'error');
                return;
            }

            const price = ethers.utils.parseEther(token.price);
            const tx = await contract.executeSale(tokenId, { value: price });
            await tx.wait();
            showStatus(`Successfully purchased Token #${tokenId}!`, 'success');
            loadNFTs(); // Refresh the grid
        } catch (error) {
            console.error(`Error buying NFT ${tokenId}:`, error);
            showStatus(`Failed to purchase NFT: ${error.message}`, 'error');
        } finally {
            hideLoader();
        }
    };

    // Event listeners
    searchInput.addEventListener('input', debounce(filterAndRenderNFTs, 300));
    priceSlider.addEventListener('input', () => {
        priceValue.textContent = `${priceSlider.value} ETH`;
        filterAndRenderNFTs();
    });
    sortSelect.addEventListener('change', filterAndRenderNFTs);

    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            filterAndRenderNFTs();
        });
    });

    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Initial load
    loadNFTs();
});
</script>
@endsection