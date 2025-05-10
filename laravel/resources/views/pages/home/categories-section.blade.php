<section class="py-10 px-6 md:px-10 bg-darker relative overflow-hidden">
    <!-- Background with Hex Grid and Particles -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#0a0a23] to-[#1e1e4a] z-[-1]">
        <div class="particle-bg" id="particle-bg"></div>
        <svg class="absolute inset-0 w-full h-full" style="opacity: 0.15; z-index: -1;">
            <defs>
                <pattern id="hexGrid" width="40" height="34.64" patternUnits="userSpaceOnUse">
                    <path d="M20 0 L40 17.32 L20 34.64 L0 17.32 Z" fill="none" stroke="#a259ff" stroke-width="0.5">
                        <animate attributeName="stroke-opacity" values="0.3;0.6;0.3" dur="4s" repeatCount="indefinite"/>
                    </path>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#hexGrid)">
                <animateTransform attributeName="transform" type="translate" from="0 0" to="40 34.64" dur="20s" repeatCount="indefinite"/>
            </rect>
        </svg>
    </div>

    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-10 neon-text glitch-text" data-text="Browse Categories">Browse Categories</h2>
        
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Category 1 -->
            <div class="category-card rounded-2xl overflow-hidden bg-gray-800" style="animation: fadeIn 0.5s ease-out forwards; animation-delay: 0.1s;">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/nft_images/art.png') }}" alt="Art" class="w-full h-full object-cover transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-center justify-center">
                        <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center icon-pulse">
                            <i class="fas fa-paint-brush text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-medium neon-text glitch-text" data-text="Art">Art</h3>
                </div>
            </div>
            
            <!-- Category 2 -->
            <div class="category-card rounded-2xl overflow-hidden bg-gray-800" style="animation: fadeIn 0.5s ease-out forwards; animation-delay: 0.2s;">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/nft_images/category_collectable.png') }}" alt="Collectibles" class="w-full h-full object-cover transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-center justify-center">
                        <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center icon-pulse">
                            <i class="fas fa-gem text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-medium neon-text glitch-text" data-text="Collectibles">Collectibles</h3>
                </div>
            </div>
            
            <!-- Category 3 -->
            <div class="category-card rounded-2xl overflow-hidden bg-gray-800" style="animation: fadeIn 0.5s ease-out forwards; animation-delay: 0.3s;">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/nft_images/Category_music.png') }}" alt="Music" class="w-full h-full object-cover transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-center justify-center">
                        <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center icon-pulse">
                            <i class="fas fa-music text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-medium neon-text glitch-text" data-text="Music">Music</h3>
                </div>
            </div>
            
            <!-- Category 4 -->
            <div class="category-card rounded-2xl overflow-hidden bg-gray-800" style="animation: fadeIn 0.5s ease-out forwards; animation-delay: 0.4s;">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/nft_images/category_photography.png') }}" alt="Photography" class="w-full h-full object-cover transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-center justify-center">
                        <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center icon-pulse">
                            <i class="fas fa-camera text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-medium neon-text glitch-text" data-text="Photography">Photography</h3>
                </div>
            </div>
            
            <!-- Category 5 -->
            <div class="category-card rounded-2xl overflow-hidden bg-gray-800" style="animation: fadeIn 0.5s ease-out forwards; animation-delay: 0.5s;">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/nft_images/category_video.png') }}" alt="Video" class="w-full h-full object-cover transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-center justify-center">
                        <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center icon-pulse">
                            <i class="fas fa-video text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-medium neon-text glitch-text" data-text="Video">Video</h3>
                </div>
            </div>
            
            <!-- Category 6 -->
            <div class="category-card rounded-2xl overflow-hidden bg-gray-800" style="animation: fadeIn 0.5s ease-out forwards; animation-delay: 0.6s;">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/nft_images/category_utility.png') }}" alt="Utility" class="w-full h-full object-cover transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-center justify-center">
                        <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center icon-pulse">
                            <i class="fas fa-tools text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-medium neon-text glitch-text" data-text="Utility">Utility</h3>
                </div>
            </div>
            
            <!-- Category 7 -->
            <div class="category-card rounded-2xl overflow-hidden bg-gray-800" style="animation: fadeIn 0.5s ease-out forwards; animation-delay: 0.7s;">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/nft_images/catrgory_sport.png') }}" alt="Sport" class="w-full h-full object-cover transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-center justify-center">
                        <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center icon-pulse">
                            <i class="fas fa-basketball-ball text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-medium neon-text glitch-text" data-text="Sport">Sport</h3>
                </div>
            </div>
            
            <!-- Category 8 -->
            <div class="category-card rounded-2xl overflow-hidden bg-gray-800" style="animation: fadeIn 0.5s ease-out forwards; animation-delay: 0.8s;">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/nft_images/category_virualworld.png') }}" alt="Virtual Worlds" class="w-full h-full object-cover transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-center justify-center">
                        <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center icon-pulse">
                            <i class="fas fa-globe text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-medium neon-text glitch-text" data-text="Virtual Worlds">Virtual Worlds</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles -->
    <style>
        /* Neon and Glitch Text */
        .neon-text {
            text-shadow: 0 0 5px #a259ff, 0 0 10px #3b82f6;
        }
        .glitch-text {
            position: relative;
            animation: glitchText 2s infinite;
        }
        .glitch-text::before, .glitch-text::after {
            content: attr(data-text);
            position: absolute;
            left: 0;
            width: 100%;
            color: #a259ff;
            opacity: 0.5;
        }
        .glitch-text::before {
            transform: translate(2px, 2px);
            animation: glitchShift 1.5s infinite;
        }
        .glitch-text::after {
            transform: translate(-2px, -2px);
            animation: glitchShift 1.5s infinite reverse;
        }
        @keyframes glitchText {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(2px, -2px); }
            60% { transform: translate(-2px, 0); }
            80% { transform: translate(2px, 0); }
            100% { transform: translate(0); }
        }
        @keyframes glitchShift {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.8; }
        }

        /* Particle Background */
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
            background: none;
            border: 2px solid #a259ff;
            border-radius: 50%;
            animation: float 8s infinite linear, pulse 2s infinite;
        }
        .particle:nth-child(odd) {
            border-color: #3b82f6;
        }
        .particle:nth-child(3n) {
            border-color: #FFD700;
        }
        @keyframes float {
            0% { transform: translateY(0) translateX(0); opacity: 0.3; }
            50% { opacity: 0.6; }
            100% { transform: translateY(-100vh) translateX(calc(10px * var(--direction))); opacity: 0; }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        /* Category Card Styles */
        .category-card {
            background: linear-gradient(45deg, rgba(162, 89, 255, 0.2), rgba(59, 130, 246, 0.2));
            border: 2px solid transparent;
            border-image: linear-gradient(to right, #a259ff, #3b82f6) 1;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: cardPulse 3s ease-in-out infinite;
            opacity: 0;
        }
        .category-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 0 20px rgba(162, 89, 255, 0.5), 0 0 40px rgba(59, 130, 246, 0.3);
        }
        .category-card:hover img {
            transform: scale(1.05);
        }
        @keyframes cardPulse {
            0%, 100% { border-image: linear-gradient(to right, #a259ff, #3b82f6) 1; }
            50% { border-image: linear-gradient(to right, #3b82f6, #a259ff) 1; }
        }
        .icon-pulse {
            transition: transform 0.3s ease;
        }
        .category-card:hover .icon-pulse {
            animation: iconPulse 1.5s ease-in-out infinite;
        }
        @keyframes iconPulse {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.2) rotate(10deg); }
        }

        /* Fade In Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create Particles
            function createParticles() {
                const particleBg = document.getElementById('particle-bg');
                for (let i = 0; i < 30; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.width = `${4 + Math.random() * 6}px`;
                    particle.style.height = particle.style.width;
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.animationDelay = `${Math.random() * 8}s`;
                    particle.style.animationDuration = `${4 + Math.random() * 6}s`;
                    particle.style.setProperty('--direction', Math.random() > 0.5 ? 1 : -1);
                    particleBg.appendChild(particle);
                }
            }

            // Add GSAP Tilt Effect to Category Cards
            const cards = document.querySelectorAll('.category-card');
            cards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    const rotateX = (y - centerY) / 30;
                    const rotateY = (centerX - x) / 30;

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

            // Initialize
            createParticles();
        });
    </script>
</section>