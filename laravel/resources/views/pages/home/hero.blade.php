
<section class="py-12 px-6 md:px-10 relative overflow-hidden">
    <!-- Cosmic Background with Particles -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#0a0a23] to-[#1e1e4a] z-[-1]">
        <div class="particle-bg" id="particle-bg"></div>
        <div class="chain-animation"></div>
    </div>

    <div class="container mx-auto grid md:grid-cols-2 gap-10 items-center relative">
        <!-- Left Column: Text and Stats -->
        <div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 neon-text typewriter glitch" style="animation: typing 1.5s steps(40, end);">Discover Digital Art</h1>
            <h1 class="text-4xl md:text-5xl font-bold mb-6 neon-text">& Collect NFTs</h1>
            <p class="text-gray-300 mb-8 leading-relaxed hidden-until" style="animation: fadeIn 0.3s ease-in 1.5s forwards;">
                Step into a decentralized metaverse marketplace powered by Ethereum. Collect, trade, and own unique digital art from over 20,000 creators.
            </p>
            <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 text-white py-3 px-8 rounded-full flex items-center w-max transition-transform hover:scale-105 pulse">
                <i class="fas fa-wallet mr-2"></i> Connect & Get Started
            </a>
            
            <div class="grid grid-cols-3 gap-6 mt-10">
                <div class="counter" data-target="240000">
                    <h3 class="text-3xl font-bold text-purple-300 neon-text">0</h3>
                    <p class="text-gray-400">Total Sales</p>
                </div>
                <div class="counter" data-target="100000">
                    <h3 class="text-3xl font-bold text-blue-300 neon-text">0</h3>
                    <p class="text-gray-400">Auctions</p>
                </div>
                <div class="counter" data-target="20000">
                    <h3 class="text-3xl font-bold text-pink-300 neon-text">0</h3>
                    <p class="text-gray-400">Artists</p>
                </div>
            </div>
        </div>
        
        <!-- Right Column: Featured NFT  https://cdn.animaapp.com/projects/6357ce7c8a65b2f16659918c/files/heroanimationtransparentbck-2.gif -->
        <div class="holographic-card rounded-2xl overflow-hidden relative group" data-id="featured-nft">
            <div class="relative h-[400px] md:h-[500px] bg-gray-900">
                <div class="orb-animation"></div>
                <img src="https://beige-main-louse-684.mypinata.cloud/ipfs/QmNWkwcj8G8PKNjE4bqDh6qC9Z5yeHPPej5zV8hvjKna6C" 
                     alt="this is my first nft #1" 
                     class="absolute inset-0 w-full h-full object-contain p-4 cursor-pointer nft-image" 
                     onclick="openModal(this.src)">
            </div>
            <div class="p-4 bg-gradient-to-t from-gray-900 to-transparent">
                <h3 class="text-xl font-bold neon-text">this is my first nft #1</h3>
                <p class="text-gray-400">SPACE NFT SUPER UNIQUE</p>
                <div class="flex justify-between mt-2">
                    <div>
                        <p class="text-gray-400 text-sm">Price</p>
                        <p class="text-purple-300">0.1 ETH</p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-400 text-sm">Token ID</p>
                        <p class="text-blue-300">#1</p>
                    </div>
                </div>
                <div class="absolute inset-0 bg-gray-900 bg-opacity-90 opacity-0 group-hover:opacity-100 transition-opacity p-4 text-gray-200 flex flex-col justify-end">
                    <p class="text-sm">Blockchain: Ethereum</p>
                    <p class="text-sm truncate">Contract: 0x1f3A2a3D9525b54DbF180365971f28B44fD8a1B2</p>
                    <p class="text-sm">Minted: Sep 30, 2022</p>
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
</section>

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    body {
        font-family: 'Orbitron', sans-serif;
    }
    .neon-text {
        text-shadow: 0 0 5px #a259ff, 0 0 10px #3b82f6;
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
    .holographic-modal {
        background: rgba(10, 10, 35, 0.9);
        border: 2px solid #a259ff;
        box-shadow: 0 0 30px rgba(162, 89, 255, 0.5);
    }
    .particle-bg {
        position: absolute;
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
    .chain-animation {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 30px;
        background: linear-gradient(to right, transparent, #a259ff, transparent);
        animation: chain-flow 5s linear infinite;
    }
    @keyframes chain-flow {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    .orb-animation {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 80%;
        height: 80%;
        border: 2px solid #a259ff;
        border-radius: 50%;
        transform: translate(-50%, -50%);
        animation: orbit 8s linear infinite;
        opacity: 0.3;
    }
    @keyframes orbit {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
    .glitch {
        animation: glitch 1s linear infinite;
    }
    @keyframes glitch {
        2%, 64% { transform: translate(2px, 0) skew(0deg); }
        4%, 60% { transform: translate(-2px, 0) skew(0deg); }
        62% { transform: translate(0, 0) skew(5deg); }
    }
    .pulse {
        animation: pulse 2s ease-in-out infinite;
    }
    @keyframes pulse {
        0%, 100% { box-shadow: 0 0 10px rgba(162, 89, 255, 0.5); }
        50% { box-shadow: 0 0 20px rgba(162, 89, 255, 0.8); }
    }
    @keyframes typing {
        from { width: 0; }
        to { width: 100%; }
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .typewriter {
        overflow: hidden;
        white-space: nowrap;
        display: inline-block;
    }
    .hidden-until {
        opacity: 0;
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

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
<script>
// Particle Background Animation
function createParticles() {
    const particleBg = document.getElementById('particle-bg');
    for (let i = 0; i < 30; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.animationDelay = `${Math.random() * 10}s`;
        particle.style.animationDuration = `${5 + Math.random() * 10}s`;
        particleBg.appendChild(particle);
    }
}

// Animated Counters
function animateCounters() {
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        let count = 0;
        const increment = target / 100;
        const updateCounter = () => {
            count += increment;
            if (count >= target) {
                counter.querySelector('h3').textContent = `${Math.floor(target).toLocaleString()}+`;
                return;
            }
            counter.querySelector('h3').textContent = `${Math.floor(count).toLocaleString()}`;
            requestAnimationFrame(updateCounter);
        };
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                updateCounter();
                observer.disconnect();
            }
        }, { threshold: 0.5 });
        observer.observe(counter);
    });
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
        img.addEventListener('dragstart', (e) => e.preventDefault());
    });
}

// Card Tilt Effect and Mouse-Reactive Background
document.addEventListener('DOMContentLoaded', function() {
    createParticles();
    animateCounters();
    disableContextMenu();

    const card = document.querySelector('.holographic-card');
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

    // Mouse-Reactive Background
    const section = document.querySelector('section');
    section.addEventListener('mousemove', (e) => {
        const x = (e.clientX / window.innerWidth - 0.5) * 20;
        const y = (e.clientY / window.innerHeight - 0.5) * 20;
        gsap.to('.particle-bg', {
            x: x,
            y: y,
            duration: 0.5,
            ease: 'power2.out'
        });
    });
});
</script>
@endpush
