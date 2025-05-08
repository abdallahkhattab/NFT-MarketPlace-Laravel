
@extends('layouts.layout')

@section('title', 'NFT Marketplace - The Orbitians')

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
                <img src="{{ asset('assets/nft_images/Trending.png') }}" alt="The Orbitians NFT" class="max-w-full max-h-[40rem] object-contain py-4 cursor-pointer nft-image" onclick="openModal(this.src)">
                <div class="absolute top-4 right-4 flex space-x-2">
                    <button class="bg-gray-900 hover:bg-gray-800 text-white p-2 rounded-lg" onclick="openModal('{{ asset('assets/nft_images/Trending.png') }}')">
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
                <h1 class="text-5xl font-bold neon-text mb-2">The Orbitians</h1>
                <p class="text-gray-400 mb-6">Minted on Sep 30, 2022 | Token ID: #1001</p>
                
                <div class="mb-6">
                    <p class="text-gray-400">Created By</p>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 flex items-center justify-center mr-2">
                            <span class="text-sm">🛸</span>
                        </div>
                        <span class="font-medium text-purple-300 hover:text-purple-100">Orbitian</span>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h2 class="text-gray-400 mb-2 text-xl">Description</h2>
                    <div class="space-y-4 text-gray-200">
                        <p>The Orbitians are 10,000 unique NFTs on the Ethereum blockchain, representing advanced beings from a cosmic civilization.</p>
                        <p>Living in orbiting metal constructs, they maintain a single foothold on Earth, embodying peace and innovation.</p>
                        <p>Engaged in an ancient war with the Upside-Downs, a rival faction, the Orbitians protect their celestial domain.</p>
                        <p>Each NFT is a portal to their universe, encoded with unique traits and stored immutably on-chain.</p>
                    </div>
                </div>
                
                <div class="mb-8">
                    <h2 class="text-gray-400 mb-2 text-xl">Details</h2>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <i class="fas fa-globe mr-2 text-purple-400"></i>
                            <a href="https://etherscan.io" target="_blank" class="text-gray-300 hover:text-purple-400">View on Etherscan</a>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-file-alt mr-2 text-purple-400"></i>
                            <a href="#" class="text-gray-300 hover:text-purple-400">View Metadata on IPFS</a>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h2 class="text-gray-400 mb-2 text-xl">Tags</h2>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-4 py-2 bg-gray-900 rounded-full text-sm border border-purple-500 text-purple-300">ANIMATION</span>
                        <span class="px-4 py-2 bg-gray-900 rounded-full text-sm border border-blue-500 text-blue-300">ILLUSTRATION</span>
                        <span class="px-4 py-2 bg-gray-900 rounded-full text-sm border border-pink-500 text-pink-300">COSMOS</span>
                        <span class="px-4 py-2 bg-gray-900 rounded-full text-sm border border-purple-500 text-purple-300">BLOCKCHAIN</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Column with Auction Info -->
            <div>
                <div class="holographic-card rounded-lg p-6 relative overflow-hidden">
                    <div class="mb-4">
                        <p class="text-gray-400 mb-2 text-lg">Auction Ends In:</p>
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
                    <button class="w-full bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 text-white font-medium py-3 px-4 rounded-lg transition transform hover:scale-105">
                        <i class="fas fa-wallet mr-2"></i> Connect Wallet to Bid
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Galactic Map Section -->
    <div class="container mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold neon-text mb-6 text-center">Galactic Map of The Orbitians</h2>
        <div class="relative h-96 bg-gray-900 rounded-lg overflow-hidden">
            <div class="absolute inset-0 bg-[url('/img/galaxy-bg.jpg')] bg-cover opacity-30"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-gray-200">
                    <p class="text-xl mb-4">Explore the Orbitians' Universe</p>
                    <p>Interactive map coming soon! Discover NFT collections across the cosmos.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- More From This Artist Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold neon-text">More From This Artist</h2>
            <a href="#" class="border border-purple-500 rounded-lg px-6 py-2 flex items-center hover:bg-purple-500 hover:text-white transition">
                <span>Go To Artist Page</span>
                <span class="ml-2">→</span>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- NFT Card 1 (Using Provided Metadata) -->
            <div class="holographic-card rounded-lg overflow-hidden relative group">
                <div class="relative pb-[100%] bg-gray-900">
                    <img src="https://beige-main-louse-684.mypinata.cloud/ipfs/QmNWkwcj8G8PKNjE4bqDh6qC9Z5yeHPPej5zV8hvjKna6C" alt="this is my first nft #1" class="absolute inset-0 w-full h-full object-contain p-2 cursor-pointer nft-image" onclick="openModal(this.src)">
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold mb-2 neon-text">this is my first nft #1</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-5 h-5 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 flex items-center justify-center mr-2">
                            <span class="text-xs">🛸</span>
                        </div>
                        <span class="text-sm text-gray-300">Orbitian</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <div>
                            <p class="text-gray-400">Price</p>
                            <p class="text-purple-300">0.1 ETH</p>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-400">Highest Bid</p>
                            <p class="text-blue-300">0.05 wETH</p>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gray-900 bg-opacity-90 opacity-0 group-hover:opacity-100 transition-opacity p-4 text-gray-200">
                        <p class="text-sm">Token ID: #1</p>
                        <p class="text-sm">Blockchain: Ethereum</p>
                        <p class="text-sm truncate">Contract: 0x1f3A2a3D9525b54DbF180365971f28B44fD8a1B2</p>
                    </div>
                </div>
            </div>
            
            <!-- NFT Card 2 -->
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
                        <span class="text-sm text-gray-300">Orbitian</span>
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
                        <p class="text-sm truncate">Contract: 0x2b4A5c6E8743c54Ec281469872f29C33eE9b2C1</p>
                    </div>
                </div>
            </div>
            
            <!-- NFT Card 3 -->
            <div class="holographic-card rounded-lg overflow-hidden relative group">
                <div class="relative pb-[100%] bg-gray-900">
                    <img src="/img/nft/psycho-dog.jpg" alt="Psycho Dog" class="absolute inset-0 w-full h-full object-contain p-2 cursor-pointer nft-image" onclick="openModal(this.src)">
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold mb-2 neon-text">Psycho Dog</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-5 h-5 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 flex items-center justify-center mr-2">
                            <span class="text-xs">🛸</span>
                        </div>
                        <span class="text-sm text-gray-300">Orbitian</span>
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
                        <p class="text-sm">Token ID: #3</p>
                        <p class="text-sm">Blockchain: Ethereum</p>
                        <p class="text-sm truncate">Contract: 0x3c5B7d8F9654d65Fd392580983f40D44fF0c3D2</p>
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
    <div id="toast" class="toast">Image saving is disabled to protect NFT ownership.</div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
<script>
// Particle Background Animation
function createParticles() {
    const particleBg = document.getElementById('particle-bg');
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
function showToast() {
    const toast = document.getElementById('toast');
    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// Disable Context Menu on NFT Images
function disableContextMenu() {
    const nftImages = document.querySelectorAll('.nft-image');
    nftImages.forEach(img => {
        img.addEventListener('contextmenu', (e) => {
            e.preventDefault();
            showToast();
        });
    });
}

// Card Tilt Effect and Initialization
document.addEventListener('DOMContentLoaded', function() {
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

    // Make all NFT images clickable
    const mainImage = document.querySelector('[alt="The Orbitians NFT"]');
    if (mainImage) {
        mainImage.classList.add('cursor-pointer');
    }

    const galleryImages = document.querySelectorAll('.grid .holographic-card img');
    galleryImages.forEach(img => {
        img.classList.add('cursor-pointer');
    });
});
</script>
@endpush
@endsection
