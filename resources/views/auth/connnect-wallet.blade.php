@extends('layouts.layout')

@section('title', 'Connect Wallet')

@push('styles')
<style>
    /* Custom Keyframes */
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 10px rgba(79, 70, 229, 0.5), 0 0 20px rgba(236, 72, 153, 0.3); }
        50% { box-shadow: 0 0 20px rgba(79, 70, 229, 0.8), 0 0 40px rgba(236, 72, 153, 0.5); }
    }
    @keyframes zoom {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    @keyframes border-pulse {
        0%, 100% { border-color: #a259ff; }
        50% { border-color: #8e42f5; }
    }
    @keyframes star-twinkle {
        0%, 100% { opacity: 0.2; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.5); }
    }
    /* Particle Styles */
    .particle {
        position: absolute;
        width: 2px;
        height: 2px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        pointer-events: none;
        animation: float 3s ease-in-out infinite;
    }
    /* Image Container Styles */
    .nft-container {
        transition: filter 0.3s ease;
    }
    .nft-container:hover {
        filter: brightness(1.2);
    }
    .nft-image {
        animation: zoom 10s ease-in-out infinite;
    }
    /* Wallet Button Styles */
    .wallet-button {
        position: relative;
        overflow: hidden;
        background: linear-gradient(45deg, #1a1a1a, #2a2a2a);
        border: 2px solid #a259ff;
        animation: border-pulse 2s infinite;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .wallet-button:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 0 20px rgba(162, 89, 255, 0.5), 0 0 40px rgba(142, 66, 245, 0.3);
    }
    .wallet-button::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 30% 30%, rgba(162, 89, 255, 0.2), transparent 70%);
        opacity: 0.3;
        transition: opacity 0.3s ease;
    }
    .wallet-button:hover::before {
        opacity: 0.6;
    }
    /* Star Particles on Hover */
    .wallet-button .star-particle {
        position: absolute;
        width: 3px;
        height: 3px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        opacity: 0;
        pointer-events: none;
    }
    .wallet-button:hover .star-particle {
        animation: star-twinkle 1.5s infinite;
    }
    .wallet-button .star-particle:nth-child(1) { top: 10%; left: 20%; animation-delay: 0s; }
    .wallet-button .star-particle:nth-child(2) { top: 30%; left: 60%; animation-delay: 0.3s; }
    .wallet-button .star-particle:nth-child(3) { top: 70%; left: 30%; animation-delay: 0.6s; }
    .wallet-button .star-particle:nth-child(4) { top: 50%; left: 80%; animation-delay: 0.9s; }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-dark flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Left Side: Image Section -->
        <div x-data="{ isHovered: false }" 
             @mousemove="isHovered = true" 
             @mouseleave="isHovered = false"
             class="relative h-96 lg:h-[600px] rounded-2xl overflow-hidden nft-container animate-pulse-glow"
             x-init="initNFTContainer($el)">
            <img src="{{ asset('assets/nft_images/register-image.png') }}" 
                 alt="NFT Space Scene" 
                 class="w-full h-full object-cover nft-image">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/70 to-transparent"></div>
            <!-- Overlay Text -->
            <div class="absolute bottom-4 left-4 text-white animate-float">
                <h3 class="text-2xl font-bold">Explore the NFT Cosmos</h3>
                <p class="text-sm">Dive into a universe of digital art</p>
            </div>
        </div>

        <!-- Right Side: Connect Wallet Section -->
        <div class="bg-darker p-8 rounded-2xl shadow-xl animate-fade-in">
            <h2 class="text-4xl font-bold text-white mb-4">Connect Wallet</h2>
            <p class="text-gray-400 mb-8">Choose a wallet you want to connect. There are several wallet providers.</p>

            <!-- Wallet Buttons -->
            <div class="space-y-6">
                <!-- MetaMask -->
                <button class="wallet-button w-full flex items-center justify-between text-white py-4 px-6 rounded-xl transition-all">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/wallet/Metamask.png') }}" alt="MetaMask Icon" class="w-8 h-8 mr-4">
                        <span class="text-lg font-semibold">MetaMask</span>
                    </div>
                    <div class="star-particle"></div>
                    <div class="star-particle"></div>
                    <div class="star-particle"></div>
                    <div class="star-particle"></div>
                </button>

                <!-- Wallet Connect -->
                <button class="wallet-button w-full flex items-center justify-between text-white py-4 px-6 rounded-xl transition-all">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/wallet/WalletConnect.png') }}" alt="Wallet Connect Icon" class="w-8 h-8 mr-4">
                        <span class="text-lg font-semibold">Wallet Connect</span>
                    </div>
                    <div class="star-particle"></div>
                    <div class="star-particle"></div>
                    <div class="star-particle"></div>
                    <div class="star-particle"></div>
                </button>

                <!-- Coinbase -->
                <button class="wallet-button w-full flex items-center justify-between text-white py-4 px-6 rounded-xl transition-all">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/wallet/Coinbase.png') }}" alt="Coinbase Icon" class="w-8 h-8 mr-4">
                        <span class="text-lg font-semibold">Coinbase</span>
                    </div>
                    <div class="star-particle"></div>
                    <div class="star-particle"></div>
                    <div class="star-particle"></div>
                    <div class="star-particle"></div>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function initNFTContainer(el) {
        // Parallax Effect
        const img = el.querySelector('img');
        el.addEventListener('mousemove', (e) => {
            const rect = el.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            img.style.transform = `scale(1.05) translate(${x * 20}px, ${y * 20}px)`;
        });
        el.addEventListener('mouseleave', () => {
            img.style.transform = 'scale(1.05)';
        });

        // Create Particles
        const createParticle = () => {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animationDuration = (Math.random() * 2 + 2) + 's';
            particle.style.animationDelay = Math.random() + 's';
            particle.style.opacity = Math.random() * 0.5 + 0.2;
            el.appendChild(particle);
            setTimeout(() => particle.remove(), 5000);
        };

        // Initialize particles
        for (let i = 0; i < 20; i++) {
            createParticle();
        }
        setInterval(createParticle, 500);
    }
</script>

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