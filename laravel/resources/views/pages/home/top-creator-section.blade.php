<section class="py-10 px-6 md:px-10 bg-darker relative overflow-hidden">
    <!-- Background with Hex Grid, Aurora, and Particles -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#0a0a23] to-[#1e1e4a] z-[-1]">
        <div class="particle-bg" id="particle-bg"></div>
        <div class="aurora-effect"></div>
        <svg class="absolute inset-0 w-full h-full" style="opacity: 0.2; z-index: -1;">
            <defs>
                <pattern id="hexGrid" width="40" height="34.64" patternUnits="userSpaceOnUse">
                    <path d="M20 0 L40 17.32 L20 34.64 L0 17.32 Z" fill="none" stroke="#a259ff" stroke-width="0.5">
                        <animate attributeName="stroke-opacity" values="0.3;0.6;0.3" dur="4s" repeatCount="indefinite"/>
                    </path>
                    <circle cx="20" cy="17.32" r="3" fill="#00f7ff">
                        <animate attributeName="r" values="3;5;3" dur="2s" repeatCount="indefinite"/>
                    </circle>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#hexGrid)">
                <animateTransform attributeName="transform" type="translate" from="0 0" to="40 34.64" dur="20s" repeatCount="indefinite"/>
            </rect>
        </svg>
    </div>

    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-bold neon-text holographic-title">Top Creators</h2>
                <p class="text-gray-300 mt-2 typewriter" style="animation: typing 2s steps(40, end) forwards;">Discover Top-Rated Creators on the NFT Marketplace</p>
            </div>
            <a href="#" class="hidden md:flex items-center border border-light-purple text-light-purple px-6 py-3 rounded-full transition-all control-module">
                <i class="fas fa-rocket mr-2"></i> View Rankings
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Creator 1 -->
            @foreach($topCreators as $topcreator)
            <div class="creator-card bg-gray-800 rounded-2xl p-5 relative overflow-hidden holographic-panel" style="animation: materialize 0.8s ease-out forwards; animation-delay: {{ 0.1 * $loop->index }}s;">
                <div class="data-stream"></div>
                <div class="creator-rank absolute -top-3 -left-3 w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold text-white rank-node">
                    <svg class="absolute w-full h-full" style="opacity: 0.5;">
                        <circle cx="50%" cy="50%" r="18" fill="none" stroke="#00f7ff" stroke-width="1">
                            <animateTransform attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="3s" repeatCount="indefinite"/>
                        </circle>
                    </svg>
                    1
                </div>
                <div class="pt-4">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 rounded-full overflow-hidden mr-4 holographic-orb">
                            <img src="{{ $topcreator->profile->avatarUrl() }}" alt="Keepitreal" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold neon-text">{{ $topcreator->name }}</h3>
                            <p class="text-gray-300 text-sm">{{'@' .$topcreator->name }}</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center border-t border-gray-700 pt-3">
                        <div>
                            <p class="text-xs text-gray-400">Total Sales</p>
                            <p class="font-medium text-light-purple">34.53 ETH</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-400">NFTs Sold</p>
                            <p class="font-medium text-white">1,245</p>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-xs text-gray-400">Top Collection: CyberPunk</span>
                        <a href="#" class="text-light-purple hover:text-purple-400 text-sm flex items-center view-link">
                            <i class="fas fa-eye mr-1"></i> View
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="flex justify-center mt-10 md:hidden">
            <a href="#" class="flex items-center border border-light-purple text-light-purple px-6 py-3 rounded-full transition-all control-module">
                <i class="fas fa-rocket mr-2"></i> View Rankings
            </a>
        </div>
    </div>

    <!-- Styles -->
    <style>
        /* Neon Text */
        .neon-text {
            color: #ffffff;
            text-shadow: 0 0 3px #a259ff, 0 0 6px #3b82f6, 0 0 8px #00f7ff;
        }

        /* Holographic Title */
        .holographic-title {
            animation: holographicEntrance 1.5s ease-out forwards;
        }
        @keyframes holographicEntrance {
            0% { opacity: 0; transform: translateY(20px) scale(0.8); text-shadow: none; }
            50% { opacity: 0.5; transform: translateY(0) scale(1.05); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        .typewriter {
            overflow: hidden;
            white-space: nowrap;
            display: inline-block;
            width: 0;
        }
        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        /* Aurora Effect */
        .aurora-effect {
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, rgba(162, 89, 255, 0.1), rgba(0, 247, 255, 0.1), rgba(59, 130, 246, 0.1));
            animation: auroraFlow 10s ease-in-out infinite;
            opacity: 0.3;
        }
        @keyframes auroraFlow {
            0% { transform: translateY(0); opacity: 0.3; }
            50% { transform: translateY(-50px); opacity: 0.5; }
            100% { transform: translateY(0); opacity: 0.3; }
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
            width: 8px;
            height: 8px;
            background: #00f7ff;
            border-radius: 50%;
            animation: dataPacket 6s infinite ease-in-out;
            opacity: 0;
        }
        .particle:nth-child(odd) {
            background: #a259ff;
        }
        .particle:nth-child(3n) {
            background: #FFD700;
        }
        @keyframes dataPacket {
            0% { transform: translateY(0) scale(0.5); opacity: 0; }
            20% { opacity: 0.8; transform: translateY(-20vh) scale(1); }
            40% { transform: translateY(-40vh) translateX(calc(20px * var(--direction))); }
            60% { opacity: 0.8; transform: translateY(-60vh) scale(1.2); }
            100% { transform: translateY(-100vh) scale(0.5); opacity: 0; }
        }

        /* Holographic Panel */
        .holographic-panel {
            background: linear-gradient(45deg, rgba(162, 89, 255, 0.2), rgba(59, 130, 246, 0.2));
            border: 2px solid transparent;
            border-image: linear-gradient(to right, #a259ff, #00f7ff) 1;
            box-shadow: 0 0 15px rgba(0, 247, 255, 0.3);
            position: relative;
            transition: transform 0.3s ease;
            opacity: 0;
        }
        .holographic-panel:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 30px rgba(0, 247, 255, 0.5), 0 0 50px rgba(162, 89, 255, 0.3);
        }
        .holographic-panel::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, #a259ff, #00f7ff);
            animation: baseGlow 2s ease-in-out infinite;
        }
        @keyframes baseGlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        /* Data Stream */
        .data-stream {
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 2px;
            height: 100%;
            background: linear-gradient(to top, #00f7ff, transparent);
            animation: dataFlow 1.5s linear infinite;
            transform: translateX(-50%);
        }
        .data-stream::after {
            content: '';
            position: absolute;
            top: 0;
            width: 6px;
            height: 6px;
            background: #00f7ff;
            border-radius: 50%;
            transform: translateX(-50%);
        }
        @keyframes dataFlow {
            0% { transform: translateX(-50%) translateY(100%); opacity: 0; }
            50% { opacity: 0.8; }
            100% { transform: translateX(-50%) translateY(0); opacity: 0; }
        }

        /* Rank Node */
        .rank-node {
            background: radial-gradient(circle, #00f7ff 20%, #a259ff 80%);
            animation: nodePulse 2s ease-in-out infinite;
        }
        @keyframes nodePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Holographic Orb */
        .holographic-orb {
            position: relative;
            transition: transform 0.3s ease;
        }
        .holographic-orb:hover {
            animation: orbSpin 4s linear infinite;
        }
        .holographic-orb::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            border: 2px solid #00f7ff;
            opacity: 0.5;
            animation: orbGlow 2s ease-in-out infinite;
        }
        @keyframes orbSpin {
            0% { transform: rotateY(0deg); }
            100% { transform: rotateY(360deg); }
        }
        @keyframes orbGlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.8; }
        }

        /* View Link */
        .view-link {
            position: relative;
            overflow: hidden;
        }
        .view-link:hover::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(0, 247, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: linkRipple 0.5s ease-out;
        }
        @keyframes linkRipple {
            0% { width: 0; height: 0; opacity: 0.5; }
            100% { width: 100px; height: 100px; opacity: 0; }
        }

        /* Control Module Button */
        .control-module {
            position: relative;
            animation: buttonPulse 2s ease-in-out infinite;
        }
        .control-module::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 9999px;
            border: 2px solid #00f7ff;
            animation: ringRotate 3s linear infinite;
            opacity: 0.5;
        }
        .control-module:hover::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(162, 89, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: buttonExplosion 0.5s ease-out;
        }
        @keyframes buttonPulse {
            0%, 100% { box-shadow: 0 0 10px rgba(0, 247, 255, 0.5); }
            50% { box-shadow: 0 0 20px rgba(0, 247, 255, 0.8); }
        }
        @keyframes ringRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes buttonExplosion {
            0% { width: 0; height: 0; opacity: 0.5; }
            100% { width: 200px; height: 200px; opacity: 0; }
        }

        /* Materialize Animation */
        @keyframes materialize {
            0% { opacity: 0; transform: translateY(30px) scale(0.8); filter: blur(5px); }
            50% { opacity: 0.5; transform: translateY(0) scale(1.05); filter: blur(0); }
            100% { opacity: 1; transform: translateY(0) scale(1); filter: blur(0); }
        }
    </style>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create Particles
            function createParticles() {
                const particleBg = document.getElementById('particle-bg');
                for (let i = 0; i < 40; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.animationDelay = `${Math.random() * 6}s`;
                    particle.style.animationDuration = `${4 + Math.random() * 4}s`;
                    particle.style.setProperty('--direction', Math.random() > 0.5 ? 1 : -1);
                    particleBg.appendChild(particle);
                }
            }

            // Add GSAP Flip Effect and Click Interaction
            const cards = document.querySelectorAll('.holographic-panel');
            cards.forEach(card => {
                // 3D Flip on Hover
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

                // Click Interaction: Data Sync Animation
                card.addEventListener('click', () => {
                    const stream = card.querySelector('.data-stream');
                    gsap.to(stream, {
                        opacity: 0.8,
                        scaleY: 1.2,
                        duration: 0.3,
                        repeat: 1,
                        yoyo: true
                    });
                });
            });

            // Scroll-Triggered Animation
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        gsap.to(entry.target.querySelectorAll('.holographic-panel'), {
                            opacity: 1,
                            duration: 0.5,
                            stagger: 0.1
                        });
                    }
                });
            }, { threshold: 0.2 });
            observer.observe(document.querySelector('.grid'));

            // Initialize
            createParticles();
        });
    </script>
</section>