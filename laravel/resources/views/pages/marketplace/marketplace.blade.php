@extends('layouts.layout')

@section('title', 'NFT Marketplace')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    /* Custom Keyframes & Animations */
    @keyframes neonFlicker {
        0% { opacity: 0; text-shadow: none; transform: translateY(10px); }
        50% { opacity: 0.7; text-shadow: 0 0 10px rgba(162, 89, 255, 0.3); }
        70% { opacity: 0.9; transform: translateY(-2px); }
        80% { opacity: 0.8; }
        100% { opacity: 1; transform: translateY(0); text-shadow: 0 0 15px rgba(162, 89, 255, 0.5); }
    }
    @keyframes typing {
        from { width: 0; }
        to { width: 100%; }
    }
    @keyframes materialize {
        0% { opacity: 0; transform: translateY(20px) scale(0.9); }
        50% { opacity: 0.6; transform: translateY(0) scale(1.02); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 0 12px rgba(162, 89, 255, 0.3), 0 0 18px rgba(142, 66, 245, 0.2); }
        50% { box-shadow: 0 0 18px rgba(162, 89, 255, 0.5), 0 0 28px rgba(142, 66, 245, 0.4); }
    }
    @keyframes nodePulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    @keyframes dataFlow {
        0% { transform: translateY(0) scale(0.5); opacity: 0; }
        20% { opacity: 0.8; transform: translateY(-20px) scale(1); }
        100% { transform: translateY(-40px) scale(0.5); opacity: 0; }
    }
    @keyframes ripple {
        0% { width: 0; height: 0; opacity: 0.5; }
        100% { width: 100px; height: 100px; opacity: 0; }
    }
    @keyframes nodeCluster {
        0%, 100% { transform: scale(1); opacity: 0.8; }
        50% { transform: scale(1.2); opacity: 1; }
    }
    @keyframes counter {
        from { transform: translateY(10px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    @keyframes tilt {
        0% { transform: rotateY(0deg) rotateX(0deg); }
        50% { transform: rotateY(5deg) rotateX(5deg); }
        100% { transform: rotateY(0deg) rotateX(0deg); }
    }
    @keyframes heartBeat {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }

    /* Page Styles */
    .page-bg {
        background: linear-gradient(180deg, #1a1a1a 0%, #121212 100%);
        background-attachment: fixed;
        position: relative;
        overflow: hidden;
    }
    .page-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 50% 50%, rgba(162, 89, 255, 0.1) 0%, transparent 70%);
        animation: pulse-light 10s infinite;
        z-index: 0;
    }
    @keyframes pulse-light {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.6; }
    }

    /* Loader Styles */
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
        position: relative;
        width: 60px;
        height: 60px;
    }
    .loader-hex {
        position: absolute;
        width: 20px;
        height: 20px;
        background: linear-gradient(135deg, #a259ff, #7b45e7);
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        animation: nodeCluster 1.5s ease-in-out infinite;
    }
    .loader-hex:nth-child(1) { top: 0; left: 20px; animation-delay: 0s; }
    .loader-hex:nth-child(2) { top: 20px; left: 0; animation-delay: 0.2s; }
    .loader-hex:nth-child(3) { top: 20px; left: 40px; animation-delay: 0.4s; }
    .loader-text {
        color: #bd83ff;
        font-size: 0.9rem;
        margin-top: 12px;
        font-family: monospace;
        animation: pulse-light 1.5s ease-in-out infinite;
    }
    .loader-text::after {
        content: '...';
        animation: dots 1.5s steps(3, end) infinite;
    }
    @keyframes dots {
        0% { content: ''; }
        33% { content: '.'; }
        66% { content: '..'; }
        100% { content: '...'; }
    }

    /* Search Bar */
    .search-wrapper {
        position: relative;
        transition: all 0.3s ease;
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
        animation: pulseGlow 2s infinite;
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
    .search-particle-flow {
        position: absolute;
        top: -10px;
        left: 0;
        width: 100%;
        height: 60px;
        pointer-events: none;
        z-index: 2;
    }

    /* Filter Panel */
    .filter-panel {
        background: rgba(25, 23, 36, 0.8);
        border: 1px solid rgba(162, 89, 255, 0.2);
        backdrop-filter: blur(8px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        animation: materialize 0.8s ease-out forwards;
    }
    .filter-btn {
        background: linear-gradient(45deg, #2a2a2a, #3a3a3a);
        border: 1px solid rgba(162, 89, 255, 0.2);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .filter-btn:hover {
        background: linear-gradient(45deg, #a259ff, #7b45e7);
        border-color: #a259ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(123, 69, 231, 0.3);
    }
    .filter-btn.active {
        background: linear-gradient(45deg, #a259ff, #7b45e7);
        border-color: #a259ff;
        animation: nodePulse 2s infinite;
    }
    .filter-btn::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(162, 89, 255, 0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.5s ease;
        opacity: 0;
    }
    .filter-btn:active::after {
        width: 100px;
        height: 100px;
        opacity: 0.5;
        transition: all 0.3s ease;
    }

    /* Price Slider */
    .price-slider {
        -webkit-appearance: none;
        height: 6px;
        background: linear-gradient(90deg, #2a2a2a, #3a3a3a);
        border-radius: 6px;
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
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23a259ff' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: calc(100% - 12px) center;
        padding-right: 32px;
        transition: all 0.3s ease;
    }
    .sort-select:focus {
        border-color: #a259ff;
        box-shadow: 0 0 0 2px rgba(162, 89, 255, 0.25);
    }

    /* Stats Section */
    .stats-section {
        background: rgba(31, 29, 43, 0.6);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(162, 89, 255, 0.2);
        border-radius: 12px;
        position: relative;
        overflow: hidden;
        animation: materialize 0.8s ease-out forwards;
    }
    .stats-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M50,10 90,35 90,65 50,90 10,65 10,35 Z" fill="none" stroke="%23a259ff" stroke-width="0.5" opacity="0.1"/></svg>');
        background-size: 50px;
        animation: pulse-light 5s infinite;
    }
    .stats-item {
        padding-right: 18px;
    }
    .stats-item:not(:last-child)::after {
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
        color: #bd83ff;
        font-weight: 600;
    }

    /* NFT Card */
    .nft-card {
        background: rgba(31, 29, 43, 0.6);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(162, 89, 255, 0.1);
        border-radius: 12px;
        position: relative;
        overflow: hidden;
        height: 100%;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        transform: perspective(1000px);
        animation: materialize 0.8s ease-out forwards;
    }
    .nft-card:hover {
        transform: perspective(1000px) translateY(-8px) scale(1.02);
        animation: card-glow 2s infinite;
        border-color: rgba(162, 89, 255, 0.5);
    }
    .nft-img-container {
        position: relative;
        overflow: hidden;
    }
    .nft-img-container::before {
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
    .nft-img-container::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(162, 89, 255, 0.2), transparent);
        animation: dataStream 3s infinite;
        opacity: 0;
        z-index: 1;
    }
    .nft-card:hover .nft-img-container::before,
    .nft-card:hover .nft-img-container::after {
        opacity: 1;
    }
    @keyframes dataStream {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
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
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .nft-card:hover .creator-badge {
        transform: scale(1.1);
        box-shadow: 0 0 8px rgba(162, 89, 255, 0.5);
    }
    .creator-name {
        color: #a0a0a0;
        font-size: 0.75rem;
        font-family: monospace;
        margin-left: 8px;
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
    .category-tag {
        background: rgba(162, 89, 255, 0.15);
        border: 1px solid rgba(162, 89, 255, 0.3);
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
    .buy-button {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(90deg, #a259ff, #7b45e7);
    color: white;
    padding: 8px 0;
    font-weight: 500;
    transform: translateY(100%);
    transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    opacity: 0;
    z-index: 3;
    cursor: pointer;

    /* Center the text */
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}

    .nft-card:hover .buy-button {
        transform: translateY(0);
        opacity: 1;
        animation: pulseGlow 2s infinite;
    }
    .buy-button:active::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(162, 89, 255, 0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        animation: ripple 0.5s ease-out;
    }
    .favorite-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(31, 29, 43, 0.7);
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(162, 89, 255, 0.3);
        backdrop-filter: blur(4px);
        opacity: 0;
        transition: all 0.3s ease;
    }
    .nft-card:hover .favorite-btn {
        opacity: 1;
        transform: scale(1);
    }
    .favorite-btn.active {
        animation: heartBeat 0.5s ease-in-out;
    }
    .favorite-btn:hover {
        background: rgba(162, 89, 255, 0.3);
        transform: scale(1.1);
    }
    .favorite-icon {
        color: white;
        font-size: 14px;
    }
    .favorite-btn.active .favorite-icon {
        color: #ff6b81;
    }

    /* Load More */
    .load-more-btn {
        background: linear-gradient(45deg, #2a2a2a, #3a3a3a);
        border: 1px solid rgba(162, 89, 255, 0.3);
        color: white;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 500;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .load-more-btn:hover {
        background: linear-gradient(45deg, #a259ff, #7b45e7);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(123, 69, 231, 0.3);
        animation: pulseGlow 2s infinite;
    }
    .load-more-btn:active::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(162, 89, 255, 0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        animation: ripple 0.5s ease-out;
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
    .troubleshooting-panel a {
        color: #bd83ff;
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .nft-card {
            max-width: none;
        }
        .stats-item {
            margin-bottom: 8px;
        }
        .stats-item::after {
            display: none;
        }
        .loader-hex {
            width: 15px;
            height: 15px;
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
@endpush

@section('content')
<div class="min-h-screen page-bg py-12 px-4 sm:px-6 lg:px-8 relative">
    <!-- Blockchain Connection Lines -->
    <div class="absolute top-0 left-0 right-0 h-12 hidden md:block connection-lines" style="z-index: 1;">
        <svg width="100%" height="100%" viewBox="0 0 1200 50" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <defs>
                <linearGradient id="lineGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#22d3ee;stop-opacity:1"/>
                    <stop offset="50%" style="stop-color:#a259ff;stop-opacity:1"/>
                    <stop offset="100%" style="stop-color:#60a5fa;stop-opacity:1"/>
                </linearGradient>
                <filter id="lineGlow">
                    <feGaussianBlur stdDeviation="1" result="coloredBlur"/>
                    <feMerge>
                        <feMergeNode in="coloredBlur"/>
                        <feMergeNode in="SourceGraphic"/>
                    </feMerge>
                </filter>
            </defs>
            <path class="connection-path" d="M100 25 L500 25" stroke="url(#lineGrad)" stroke-width="2" stroke-dasharray="10,5" opacity="0.7" filter="url(#lineGlow)">
                <animate attributeName="stroke-dashoffset" from="15" to="0" dur="2s" repeatCount="indefinite"/>
            </path>
            <path class="connection-path" d="M700 25 L1100 25" stroke="url(#lineGrad)" stroke-width="2" stroke-dasharray="10,5" opacity="0.7" filter="url(#lineGlow)">
                <animate attributeName="stroke-dashoffset" from="15" to="0" dur="2s" repeatCount="indefinite"/>
            </path>
            <circle cx="100" cy="25" r="5" fill="#22d3ee" filter="url(#lineGlow)">
                <animate attributeName="r" values="5;6;5" dur="2s" repeatCount="indefinite"/>
            </circle>
            <circle cx="500" cy="25" r="5" fill="#a259ff" filter="url(#lineGlow)">
                <animate attributeName="r" values="5;6;5" dur="2s" repeatCount="indefinite"/>
            </circle>
            <circle cx="700" cy="25" r="5" fill="#a259ff" filter="url(#lineGlow)">
                <animate attributeName="r" values="5;6;5" dur="2s" repeatCount="indefinite"/>
            </circle>
            <circle cx="1100" cy="25" r="5" fill="#60a5fa" filter="url(#lineGlow)">
                <animate attributeName="r" values="5;6;5" dur="2s" repeatCount="indefinite"/>
            </circle>
            <circle class="data-packet" cx="100" cy="25" r="3" fill="#22d3ee" filter="url(#lineGlow)">
                <animateMotion dur="2s" repeatCount="indefinite" path="M100 25 L500 25"/>
            </circle>
            <circle class="data-packet" cx="700" cy="25" r="3" fill="#a259ff" filter="url(#lineGlow)">
                <animateMotion dur="2s" repeatCount="indefinite" path="M700 25 L1100 25"/>
)l            </circle>
        </svg>
    </div>

    <!-- Marketplace Header -->
    <div class="text-center mb-12 relative" style="z-index: 2;">
        <h1 class="text-4xl md:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-500 neon-flicker">NFT Marketplace</h1>
        <p class="text-gray-400 max-w-2xl mx-auto typewriter" style="animation: typing 2s steps(30, end) forwards;">Discover, collect, and sell extraordinary NFTs from top creators and collections.</p>
    </div>

    <!-- Advanced Search & Filter Section -->
    <div class="max-w-6xl mx-auto mb-10 relative" style="z-index: 2;">
        <div class="filter-panel rounded-xl p-6">
            <div class="search-wrapper mb-6">
                <div class="search-particle-flow" id="search-particle-flow"></div>
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
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
    <div class="max-w-6xl mx-auto mb-8 relative" style="z-index: 2;">
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
    <div class="max-w-6xl mx-auto relative" style="z-index: 2;">
        <div class="relative">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 grid-loading" id="nft-grid">
                <!-- Dynamic NFTs will be populated here -->
            </div>
            <div class="loader-overlay" id="loader-overlay">
                <div class="text-center">
                    <div class="loader">
                        <div class="loader-hex"></div>
                        <div class="loader-hex"></div>
                        <div class="loader-hex"></div>
                    </div>
                    <p class="loader-text">Loading NFTs</p>
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
    // Particle Generation
    function createParticles(containerId, count = 10) {
        const container = document.getElementById(containerId);
        for (let i = 0; i < count; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.animationDelay = `${Math.random() * 3}s`;
            particle.style.background = i % 2 === 0 ? '#22d3ee' : '#a259ff';
            container.appendChild(particle);
        }
    }

    // Scroll-Triggered Animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                gsap.to(entry.target, {
                    opacity: 1,
                    duration: 0.8
                });
                if (entry.target.classList.contains('nft-card')) {
                    gsap.to(entry.target, {
                        opacity: 1,
                        duration: 0.8,
                        stagger: 0.2
                    });
                }
                if (entry.target.id === 'stats-items') {
                    const counters = entry.target.querySelectorAll('.stats-value');
                    counters.forEach(counter => {
                        const target = parseInt(counter.textContent) || 0;
                        gsap.fromTo(counter, 
                            { textContent: 0, opacity: 0, y: 10 }, 
                            { 
                                textContent: target, 
                                opacity: 1, 
                                y: 0, 
                                duration: 1, 
                                snap: { textContent: 1 }, 
                                ease: 'power2.out',
                                onUpdate: function() {
                                    counter.textContent = Math.ceil(this.targets()[0].textContent);
                                }
                            }
                        );
                    });
                }
            }
        });
    }, { threshold: 0.2 });

    // Hover Effects
    function addHoverEffects() {
        document.querySelectorAll('.nft-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                gsap.to(card, {
                    rotationY: x / 50,
                    rotationX: -y / 50,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    rotationY: 0,
                    rotationX: 0,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
        });
    }

    // Initialize Animations
    createParticles('search-particle-flow');
    observer.observe(document.querySelector('.filter-panel'));
    observer.observe(document.querySelector('#stats-items'));
    observer.observe(document.querySelector('#nft-grid'));

    // Web3 and NFT Logic (Unchanged)
    if (!window.ethers) {
        console.error('Ethers.js failed to load.');
        showStatus('Failed to load blockchain library. Please refresh the page or check your network.', 'error');
        document.getElementById('nft-grid').innerHTML = '<p class="text-gray-400 text-center col-span-4">Unable to load NFTs due to missing library.</p>';
        document.getElementById('loader-overlay').style.display = 'none';
        return;
    }

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

    const web3Config = @json($web3Config ?? [
        'contractAddress' => '0x636937bac8A853767CF2422D4eDcCd2CC9e190d0',
        'contractABI' => []
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

    const nftGrid = document.getElementById('nft-grid');
    const loaderOverlay = document.getElementById('loader-overlay');
    const searchInput = document.getElementById('search-input');
    const priceSlider = document.getElementById('price-slider');
    const priceValue = document.getElementById('price-value');
    const sortSelect = document.getElementById('sort-select');
    const nftCount = document.getElementById('nft-count');
    const showingCount = document.getElementById('showing-count');
    const totalCount = document.getElementById('total-count');

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
                const expectedChainId = 11155111;
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

    async function fetchMetadata(ipfsHash, tokenId) {
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
        showStatus(`Unable to load metadata for Token #${tokenId}.`, 'warning');
        return {
            name: `Token #${tokenId}`,
            description: "Metadata unavailable",
            image: "https://via.placeholder.com/400x400?text=NFT+Image",
            category: "Unknown",
            isFallback: true
        };
    }

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
            console.error('Error loading NFTs:', {
                message: error.message,
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

    function updateStats() {
        nftCount.textContent = nfts.length;
        totalCount.textContent = filteredNFTs.length;
        showingCount.textContent = Math.min(currentPage * perPage, filteredNFTs.length);
    }

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

        filteredNFTs.sort((a, b) => {
            if (sortOption === 'price-low') {
                return parseFloat(a.price) - parseFloat(b.price);
            } else if (sortOption === 'price-high') {
                return parseFloat(b.price) - parseFloat(a.price);
            } else if (sortOption === 'recent') {
                return b.tokenId - a.tokenId;
            } else if (sortOption === 'popular') {
                return (b.views || 0) - (a.views || 0);
            }
            return 0;
        });

        currentPage = 1;
        renderNFTs();
        updateStats();
    }

    function renderNFTs() {
        const start = (currentPage - 1) * perPage;
        const end = start + perPage;
        const nftsToShow = filteredNFTs.slice(start, end);

        nftGrid.innerHTML = '';
        if (nftsToShow.length === 0) {
            nftGrid.innerHTML = '<p class="text-gray-400 text-center col-span-4">No NFTs match your filters.</p>';
            return;
        }

        nftsToShow.forEach((nft, index) => {
            const card = document.createElement('div');
            card.className = 'nft-card rounded-lg';
            card.style.animationDelay = `${index * 0.2}s`;
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
                        <div class="creator-badge">
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

        addHoverEffects();
        document.querySelector('.load-more-btn').style.display = end >= filteredNFTs.length ? 'none' : 'block';
    }

    window.loadMoreNFTs = function() {
        currentPage++;
        renderNFTs();
        updateStats();
    };

    window.searchNFTs = function() {
        filterAndRenderNFTs();
    };

    window.clearSearch = function() {
        searchInput.value = '';
        filterAndRenderNFTs();
    };

    window.toggleFavorite = function(tokenId, event) {
        event.stopPropagation();
        const btn = event.currentTarget;
        btn.classList.toggle('active');
        showStatus(`Favorite toggled for Token #${tokenId}`, 'success');
    };

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
            loadNFTs();
        } catch (error) {
            console.error(`Error buying NFT ${tokenId}:`, error);
            showStatus(`Failed to purchase NFT: ${error.message}`, 'error');
        } finally {
            hideLoader();
        }
    };

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

    loadNFTs();
});
</script>
@endsection
