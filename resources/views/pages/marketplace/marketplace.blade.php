@extends('layouts.layout')

@section('title', 'NFT Marketplace')

@push('styles')
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
    
    /* Page Styles */
    .page-bg {
        background: linear-gradient(180deg, #1a1a1a 0%, #121212 100%);
        background-attachment: fixed;
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
        padding-right: 80px; /* Space for buttons */
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
    
    /* NFT Card Styles - Enhanced */
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
    
    /* Buy Now Button - Shows on Hover */
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
    
    /* Responsive breakpoints refinements */
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
    }
</style>
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
                    placeholder="Search NFTs, collections, or creators" 
                    class="search-input w-full py-3 px-5 text-white rounded-lg focus:outline-none"
                >
                <div class="search-buttons">
                    <button class="search-btn text-purple-300 hover:text-purple-100">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    <button class="search-btn text-purple-300 hover:text-purple-100">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Filter Options -->
            <div class="">
                <!-- Categories Filter -->
                <div class="">
                    <h3 class="text-white font-medium mb-3 ">Categories</h3>
                    <div class="flex flex-wrap gap-2 justify-center">
                        <button class="filter-btn text-xs px-3 py-2 rounded-lg text-white active">All</button>
                        <button class="filter-btn text-xs px-3 py-2 rounded-lg text-white">Art</button>
                        <button class="filter-btn text-xs px-3 py-2 rounded-lg text-white ">Collectibles</button>
                        <button class="filter-btn text-xs px-3 py-2 rounded-lg text-white">Music</button>
                        <button class="filter-btn text-xs px-3 py-2 rounded-lg text-white">Photography</button>
                        <button class="filter-btn text-xs px-3 py-2 rounded-lg text-white">Gaming</button>
                    </div>
                </div>
                
                <!-- Price Range Filter -->
                <div>
                    <h3 class="text-white font-medium mb-3">Price Range</h3>
                    <div class="price-slider-container">
                        <input type="range" min="0" max="100" value="50" class="price-slider w-full">
                        <div class="price-values">
                            <span>0 ETH</span>
                            <span class="price-current" id="priceValue">2.5 ETH</span>
                            <span>5+ ETH</span>
                        </div>
                    </div>
                </div>
                
                <!-- Sort By Options -->
                <div>
                    <h3 class="text-white font-medium mb-3">Sort By</h3>
                    <select class="sort-select w-full focus:outline-none">
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
            <div class="flex flex-wrap items-center space-x-4">
                <div class="stats-item">
                    <span class="text-white font-medium">NFTs</span>
                    <span class="ml-2 stats-value">302</span>
                </div>
                <div class="stats-item">
                    <span class="text-white font-medium">Collections</span>
                    <span class="ml-2 stats-value">67</span>
                </div>
                <div class="stats-item">
                    <span class="text-white font-medium">Volume</span>
                    <span class="ml-2 stats-value">235.88 ETH</span>
                </div>
            </div>
            <div class="text-gray-400 text-sm">
                Showing <span class="text-white">12</span> of <span class="text-white">302</span> NFTs
            </div>
        </div>
    </div>

    <!-- NFT Grid - Enhanced Cards, 4 per row on larger screens -->
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 grid-loading">
            <!-- NFT Card 1 -->
            <div class="nft-card rounded-xl" style="animation: fadeIn 0.5s ease-out forwards; animation-delay: 0.1s;">
                <div class="nft-img-container h-40">
                    <img src="{{ asset('assets/nft_images/magic2.png') }}" alt="Magic Mushroom 0325" class="w-full h-full object-cover">
                    <span class="category-tag">Art</span>
                    <button class="favorite-btn">
                        <svg class="favorite-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                </div>
                <div class="nft-content">
                    <h3 class="nft-title">Magic Mushroom 0325</h3>
                    <div class="nft-creator">
                        <div class="w-6 h-6 rounded-full overflow-hidden creator-badge">
                            <img src="/api/placeholder/30/30" alt="MoonDancer" class="w-full h-full object-cover">
                        </div>
                        <span class="creator-name">MoonDancer</span>
                    </div>
                    <div class="nft-details">
                        <div>
                            <p class="price-label">Price</p>
                            <p class="price-value">1.63 ETH</p>
                        </div>
                        <div class="text-right">
                            <p class="bid-label">Highest Bid</p>
                            <p class="bid-value">0.33 wETH</p>
                        </div>
                    </div>
                </div>
                <div class="buy-button">Buy Now</div>
            </div>

            <!-- NFT Card 2 -->
            <div class="nft-card rounded-xl" style="animation: fadeIn 0.5s ease-out forwards; animation-delay: 0.15s;">
                <div class="nft-img-container h-40">
                    <img src="{{ asset('assets/nft_images/happy_robot_032.png') }}" alt="Happy Robot 032" class="w-full h-full object-cover">
                    <span class="category-tag">Collectibles</span>
                    <button class="favorite-btn">
                        <svg class="favorite-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                </div>
                <div class="nft-content">
                    <h3 class="nft-title">Happy Robot 032</h3>
                    <div class="nft-creator">
                        <div class="w-6 h-6 rounded-full overflow-hidden creator-badge">
                            <img src="/api/placeholder/30/30" alt="BeKind2Robots" class="w-full h-full object-cover">
                        </div>
                        <span class="creator-name">BeKind2Robots</span>
                    </div>
                    <div class="nft-details">
                        <div>
                            <p class="price-label">Price</p>
                            <p class="price-value">1.63 ETH</p>
                        </div>
                        <div class="text-right">
                            <p class="bid-label">Highest Bid</p>
                            <p class="bid-value">0.33 wETH</p>
                        </div>
                    </div>
                </div>
                <div class="buy-button">Buy Now</div>
            </div>

            <!-- NFT Card 3 -->
         

            <!-- NFT Card 4 -->
            <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.1s;">
                <img src="{{ asset('assets/nft_images/designer_bear.png') }}" alt="Designer Bear" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white">Designer Bear</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <img src="/api/placeholder/50/50" alt="Mr Fox" class="w-full h-full object-cover">
                        </div>
                        <span class="text-sm text-gray-400 ml-2">By Mr Fox</span>
                    </div>
                    <div class="flex justify-between mt-4">
                        <div>
                            <p class="text-xs text-gray-400">Price</p>
                            <p class="text-sm text-white">1.63 ETH</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Highest Bid</p>
                            <p class="text-sm text-white">0.33 wETH</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NFT Card 5 -->
            <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.2s;">
                <img src="{{ asset('assets/nft_images/trending_collection2.png') }}" alt="Colorful Dog 0356" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white">Colorful Dog 0356</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <img src="/api/placeholder/50/50" alt="Keepitreal" class="w-full h-full object-cover">
                        </div>
                        <span class="text-sm text-gray-400 ml-2">By Keepitreal</span>
                    </div>
                    <div class="flex justify-between mt-4">
                        <div>
                            <p class="text-xs text-gray-400">Price</p>
                            <p class="text-sm text-white">1.63 ETH</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Highest Bid</p>
                            <p class="text-sm text-white">0.33 wETH</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NFT Card 6 -->
            <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.3s;">
                <img src="{{ asset('assets/nft_images/dancing_robot_0312.png') }}" alt="Dancing Robot 0312" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white">Dancing Robot 0312</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <img src="/api/placeholder/50/50" alt="Robotica" class="w-full h-full object-cover">
                        </div>
                        <span class="text-sm text-gray-400 ml-2">By Robotica</span>
                    </div>
                    <div class="flex justify-between mt-4">
                        <div>
                            <p class="text-xs text-gray-400">Price</p>
                            <p class="text-sm text-white">1.63 ETH</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Highest Bid</p>
                            <p class="text-sm text-white">0.33 wETH</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NFT Card 7 -->
            <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.1s;">
                <img src="{{ asset('assets/nft_images/cherry_blossom_girl_035.png') }}" alt="Cherry Blossom Girl 035" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white">Cherry Blossom Girl 035</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <img src="/api/placeholder/50/50" alt="MoonDancer" class="w-full h-full object-cover">
                        </div>
                        <span class="text-sm text-gray-400 ml-2">By MoonDancer</span>
                    </div>
                    <div class="flex justify-between mt-4">
                        <div>
                            <p class="text-xs text-gray-400">Price</p>
                            <p class="text-sm text-white">1.63 ETH</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Highest Bid</p>
                            <p class="text-sm text-white">0.33 wETH</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NFT Card 8 -->
            <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.2s;">
                <img src="{{ asset('assets/nft_images/space_travel.png') }}" alt="Space Travel" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white">Space Travel</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <img src="/api/placeholder/50/50" alt="NebulaKid" class="w-full h-full object-cover">
                        </div>
                        <span class="text-sm text-gray-400 ml-2">By NebulaKid</span>
                    </div>
                    <div class="flex justify-between mt-4">
                        <div>
                            <p class="text-xs text-gray-400">Price</p>
                            <p class="text-sm text-white">1.63 ETH</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Highest Bid</p>
                            <p class="text-sm text-white">0.33 wETH</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NFT Card 9 -->
            <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.3s;">
                <img src="{{ asset('assets/nft_images/sunset_dimension.png') }}" alt="Sunset Dimension" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white">Sunset Dimension</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <img src="/api/placeholder/50/50" alt="Animakid" class="w-full h-full object-cover">
                        </div>
                        <span class="text-sm text-gray-400 ml-2">By Animakid</span>
                    </div>
                    <div class="flex justify-between mt-4">
                        <div>
                            <p class="text-xs text-gray-400">Price</p>
                            <p class="text-sm text-white">1.63 ETH</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Highest Bid</p>
                            <p class="text-sm text-white">0.33 wETH</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NFT Card 10 -->
            <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.1s;">
                <img src="{{ asset('assets/nft_images/desert_walk.png') }}" alt="Desert Walk" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white">Desert Walk</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <img src="/api/placeholder/50/50" alt="Catch 22" class="w-full h-full object-cover">
                        </div>
                        <span class="text-sm text-gray-400 ml-2">By Catch 22</span>
                    </div>
                    <div class="flex justify-between mt-4">
                        <div>
                            <p class="text-xs text-gray-400">Price</p>
                            <p class="text-sm text-white">1.63 ETH</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Highest Bid</p>
                            <p class="text-sm text-white">0.33 wETH</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NFT Card 11 -->
            <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.2s;">
                <img src="{{ asset('assets/nft_images/icecream_ape_0324.png') }}" alt="IceCream Ape 0324" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white">IceCream Ape 0324</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <img src="/api/placeholder/50/50" alt="Ice Club" class="w-full h-full object-cover">
                        </div>
                        <span class="text-sm text-gray-400 ml-2">By Ice Club</span>
                    </div>
                    <div class="flex justify-between mt-4">
                        <div>
                            <p class="text-xs text-gray-400">Price</p>
                            <p class="text-sm text-white">1.63 ETH</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Highest Bid</p>
                            <p class="text-sm text-white">0.33 wETH</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NFT Card 12 -->
            <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.3s;">
                <img src="{{ asset('assets/nft_images/colorful_dog_0344.png') }}" alt="Colorful Dog 0344" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white">Colorful Dog 0344</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <img src="/api/placeholder/50/50" alt="PuppyPower" class="w-full h-full object-cover">
                        </div>
                        <span class="text-sm text-gray-400 ml-2">By PuppyPower</span>
                    </div>
                    <div class="flex justify-between mt-4">
                        <div>
                            <p class="text-xs text-gray-400">Price</p>
                            <p class="text-sm text-white">1.63 ETH</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Highest Bid</p>
                            <p class="text-sm text-white">0.33 wETH</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 1s ease-out forwards;
    }
</style>
@endpush