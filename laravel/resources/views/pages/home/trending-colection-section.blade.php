<style>
    /* Card entrance animation */
    .nft-card {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.6s ease-out forwards;
    }
    .nft-card:nth-child(1) { animation-delay: 0.2s; }
    .nft-card:nth-child(2) { animation-delay: 0.4s; }
    .nft-card:nth-child(3) { animation-delay: 0.6s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Hover effect for cards */
    .nft-card:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
        box-shadow: 0 0 20px rgba(0, 255, 204, 0.5);
    }

    /* Glitch effect for text */
    .glitch-text {
        animation: glitch 2s infinite;
    }
    @keyframes glitch {
        0% { transform: translate(0); }
        20% { transform: translate(-2px, 2px); }
        40% { transform: translate(2px, -2px); }
        60% { transform: translate(-2px, 0); }
        80% { transform: translate(2px, 0); }
        100% { transform: translate(0); }
    }

    /* Pulsing glow for SVGs */
    .glow-pulse {
        animation: pulse 1.5s infinite ease-in-out;
    }
    @keyframes pulse {
        0%, 100% { opacity: 0.6; }
        50% { opacity: 1; }
    }
</style>

<section class="py-10 px-6 md:px-10">
    <div class="container mx-auto">
        <div class="mb-10">
            <h2 class="text-3xl font-bold">Trending Collections</h2>
            <p class="text-gray-400 mt-2">Discover Our Weekly Updated Trending Collections</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Collection 1: CryptoVoxels -->
            <div class="nft-card rounded-2xl overflow-hidden">
                <div class="h-64 overflow-hidden">
                    <svg width="400" height="300" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="cryptoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#0f2027;stop-opacity:1"/>
                                <stop offset="50%" style="stop-color:#203a43;stop-opacity:1"/>
                                <stop offset="100%" style="stop-color:#2c5364;stop-opacity:1"/>
                            </linearGradient>
                            <filter id="neonGlow">
                                <feGaussianBlur stdDeviation="2.5" result="coloredBlur"/>
                                <feMerge>
                                    <feMergeNode in="coloredBlur"/>
                                    <feMergeNode in="SourceGraphic"/>
                                </feMerge>
                            </filter>
                            <pattern id="gridPattern" width="40" height="40" patternUnits="userSpaceOnUse">
                                <rect width="40" height="40" fill="none" stroke="#00ffcc" stroke-width="0.5" opacity="0.3"/>
                            </pattern>
                        </defs>
                        <!-- Background -->
                        <rect width="400" height="300" fill="url(#cryptoGrad)"/>
                        <rect width="400" height="300" fill="url(#gridPattern)">
                            <animateTransform attributeName="transform" type="translate" from="0 0" to="40 40" dur="10s" repeatCount="indefinite"/>
                        </rect>
                        
                        <!-- Blockchain Cubes -->
                        <g transform="translate(200, 150)">
                            <!-- Cube 1 with rotation -->
                            <g transform="translate(-60, -20)">
                                <path d="M0,0 l30,-15 l30,15 l-30,15 z" fill="#00ffcc" opacity="0.8" filter="url(#neonGlow)">
                                    <animateTransform attributeName="transform" type="rotate" from="0 30 0" to="360 30 0" dur="8s" repeatCount="indefinite"/>
                                </path>
                                <path d="M0,0 l0,30 l30,15 l0,-30 z" fill="#00ccff" opacity="0.6"/>
                                <path d="M60,0 l0,30 l-30,15 l0,-30 z" fill="#0099ff" opacity="0.4"/>
                                <text x="15" y="10" font-family="monospace" font-size="8" fill="white" class="glitch-text">0x5F3e</text>
                            </g>
                            <!-- Cube 2 with rotation -->
                            <g transform="translate(20, 10)">
                                <path d="M0,0 l30,-15 l30,15 l-30,15 z" fill="#ff3399" opacity="0.8" filter="url(#neonGlow)">
                                    <animateTransform attributeName="transform" type="rotate" from="360 30 0" to="0 30 0" dur="8s" repeatCount="indefinite"/>
                                </path>
                                <path d="M0,0 l0,30 l30,15 l0,-30 z" fill="#cc33ff" opacity="0.6"/>
                                <path d="M60,0 l0,30 l-30,15 l0,-30 z" fill="#9933ff" opacity="0.4"/>
                                <text x="15" y="10" font-family="monospace" font-size="8" fill="white" class="glitch-text">0xA7Bd</text>
                            </g>
                            <!-- Pulsing connection line -->
                            <line x1="-30" y1="0" x2="20" y2="10" stroke="#00ffcc" stroke-width="2" stroke-dasharray="5,3" filter="url(#neonGlow)">
                                <animate attributeName="opacity" values="0.4;1;0.4" dur="2s" repeatCount="indefinite"/>
                            </line>
                            <circle cx="-30" cy="0" r="3" fill="#00ffcc" filter="url(#neonGlow)" class="glow-pulse"/>
                            <circle cx="20" cy="10" r="3" fill="#ff3399" filter="url(#neonGlow)" class="glow-pulse"/>
                        </g>
                        
                        <!-- Animated data streams -->
                        <text x="30" y="40" font-family="monospace" font-size="10" fill="#00ffcc" opacity="0.7" filter="url(#neonGlow)" class="glitch-text">
                            0x734F2a9c...
                            <animate attributeName="y" from="40" to="0" dur="5s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" from="0.7" to="0" dur="5s" repeatCount="indefinite"/>
                        </text>
                        <text x="250" y="270" font-family="monospace" font-size="10" fill="#00ffcc" opacity="0.7" filter="url(#neonGlow)" class="glitch-text">
                            0xEf971B3d...
                            <animate attributeName="y" from="270" to="300" dur="5s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" from="0.7" to="0" dur="5s" repeatCount="indefinite"/>
                        </text>
                        
                        <!-- ETH Symbol with pulsation -->
                        <g transform="translate(330, 50) scale(0.5)">
                            <path d="M50,0 L100,60 L50,85 L0,60 Z" fill="none" stroke="#00ffcc" stroke-width="2" filter="url(#neonGlow)">
                                <animate attributeName="opacity" values="0.6;1;0.6" dur="1.5s" repeatCount="indefinite"/>
                            </path>
                            <path d="M50,45 L100,60 L50,85 L0,60 Z" fill="none" stroke="#00ffcc" stroke-width="2" filter="url(#neonGlow)">
                                <animate attributeName="opacity" values="0.6;1;0.6" dur="1.5s" repeatCount="indefinite"/>
                            </path>
                            <line x1="50" y1="0" x2="50" y2="85" stroke="#00ffcc" stroke-width="2" filter="url(#neonGlow)">
                                <animate attributeName="opacity" values="0.6;1;0.6" dur="1.5s" repeatCount="indefinite"/>
                            </line>
                        </g>
                    </svg>
                </div>
                <div class="grid grid-cols-3 gap-2 p-4">
                    <div class="rounded-xl overflow-hidden">
                        <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <rect width="100" height="100" fill="#0f2027"/>
                            <path d="M25,25 l25,-15 l25,15 l-25,15 z" fill="#00ffcc" opacity="0.8">
                                <animateTransform attributeName="transform" type="rotate" from="0 50 25" to="360 50 25" dur="6s" repeatCount="indefinite"/>
                            </path>
                            <text x="35" y="35" font-family="monospace" font-size="8" fill="white" class="glitch-text">#024</text>
                        </svg>
                    </div>
                    <div class="rounded-xl overflow-hidden">
                        <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <rect width="100" height="100" fill="#203a43"/>
                            <path d="M25,25 l25,-15 l25,15 l-25,15 z" fill="#ff3399" opacity="0.8">
                                <animateTransform attributeName="transform" type="rotate" from="360 50 25" to="0 50 25" dur="6s" repeatCount="indefinite"/>
                            </path>
                            <text x="35" y="35" font-family="monospace" font-size="8" fill="white" class="glitch-text">#103</text>
                        </svg>
                    </div>
                    <div class="rounded-xl overflow-hidden bg-light-purple flex items-center justify-center">
                        <span class="text-white font-bold">1025+</span>
                    </div>
                </div>
                <div class="p-5 pt-0">
                    <h3 class="text-xl font-bold mb-3">CryptoVoxels</h3>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <svg width="50" height="50" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="25" cy="25" r="25" fill="#0f2027"/>
                                <text x="12" y="30" font-family="monospace" font-size="10" fill="#00ffcc" class="glitch-text">0x</text>
                            </svg>
                        </div>
                        <span class="ml-2 text-gray-300">BlockMaster</span>
                    </div>
                </div>
            </div>
            
            <!-- Collection 2: Blockchain Punks -->
            <div class="nft-card rounded-2xl overflow-hidden">
                <div class="h-64 overflow-hidden">
                    <svg width="400" height="300" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="punkGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#121212;stop-opacity:1"/>
                                <stop offset="100%" style="stop-color:#380036;stop-opacity:1"/>
                            </linearGradient>
                            <filter id="punkGlow">
                                <feGaussianBlur stdDeviation="2" result="coloredBlur"/>
                                <feMerge>
                                    <feMergeNode in="coloredBlur"/>
                                    <feMergeNode in="SourceGraphic"/>
                                </feMerge>
                            </filter>
                            <pattern id="pixelGrid" width="20" height="20" patternUnits="userSpaceOnUse">
                                <rect width="20" height="20" fill="none" stroke="#ff00ff" stroke-width="0.5" opacity="0.2"/>
                            </pattern>
                        </defs>
                        <!-- Background -->
                        <rect width="400" height="300" fill="url(#punkGrad)"/>
                        <rect width="400" height="300" fill="url(#pixelGrid)">
                            <animateTransform attributeName="transform" type="translate" from="0 0" to="20 20" dur="8s" repeatCount="indefinite"/>
                        </rect>
                        
                        <!-- Pixel Art Character -->
                        <g transform="translate(160, 100)">
                            <!-- Pixel Head -->
                            <rect x="0" y="0" width="80" height="80" fill="#7CFC00" rx="5"/>
                            <!-- Pixel Face -->
                            <rect x="20" y="20" width="15" height="15" fill="#000"/>
                            <rect x="50" y="20" width="15" height="15" fill="#000"/>
                            <rect x="30" y="55" width="25" height="5" fill="#000"/>
                            <!-- Cyber Accessories with flicker -->
                            <rect x="-10" y="30" width="10" height="5" fill="#00ffff" filter="url(#punkGlow)">
                                <animate attributeName="opacity" values="0.5;1;0.5" dur="1s" repeatCount="indefinite"/>
                            </rect>
                            <rect x="80" y="30" width="10" height="5" fill="#00ffff" filter="url(#punkGlow)">
                                <animate attributeName="opacity" values="0.5;1;0.5" dur="1s" repeatCount="indefinite"/>
                            </rect>
                            <rect x="20" y="-10" width="5" height="10" fill="#ff00ff" filter="url(#punkGlow)">
                                <animate attributeName="opacity" values="0.5;1;0.5" dur="1.2s" repeatCount="indefinite"/>
                            </rect>
                            <rect x="60" y="-10" width="5" height="10" fill="#ff00ff" filter="url(#punkGlow)">
                                <animate attributeName="opacity" values="0.5;1;0.5" dur="1.2s" repeatCount="indefinite"/>
                            </rect>
                        </g>
                        
                        <!-- Blockchain elements -->
                        <g transform="translate(0, 0)">
                            <rect x="20" y="20" width="100" height="40" rx="5" fill="none" stroke="#ff00ff" stroke-width="2">
                                <animate attributeName="stroke-opacity" values="0.5;1;0.5" dur="2s" repeatCount="indefinite"/>
                            </rect>
                            <text x="35" y="45" font-family="monospace" font-size="12" fill="#ff00ff" class="glitch-text">#3087</text>
                        </g>
                        <g transform="translate(280, 240)">
                            <rect x="0" y="0" width="100" height="40" rx="5" fill="none" stroke="#00ffff" stroke-width="2">
                                <animate attributeName="stroke-opacity" values="0.5;1;0.5" dur="2s" repeatCount="indefinite"/>
                            </rect>
                            <text x="15" y="25" font-family="monospace" font-size="12" fill="#00ffff" class="glitch-text">#00a328f9</text>
                        </g>
                        
                        <!-- Connecting blockchain nodes with pulsation -->
                        <circle cx="50" cy="220" r="15" fill="none" stroke="#ff00ff" stroke-width="2" class="glow-pulse"/>
                        <circle cx="120" cy="250" r="10" fill="none" stroke="#ff00ff" stroke-width="2" class="glow-pulse"/>
                        <circle cx="200" cy="230" r="12" fill="none" stroke="#ff00ff" stroke-width="2" class="glow-pulse"/>
                        <line x1="50" y1="220" x2="120" y2="250" stroke="#ff00ff" stroke-width="1" stroke-dasharray="5,3">
                            <animate attributeName="stroke-opacity" values="0.4;1;0.4" dur="1.5s" repeatCount="indefinite"/>
                        </line>
                        <line x1="120" y1="250" x2="200" y2="230" stroke="#ff00ff" stroke-width="1" stroke-dasharray="5,3">
                            <animate attributeName="stroke-opacity" values="0.4;1;0.4" dur="1.5s" repeatCount="indefinite"/>
                        </line>
                        <line x1="200" y1="230" x2="280" y2="240" stroke="#ff00ff" stroke-width="1" stroke-dasharray="5,3">
                            <animate attributeName="stroke-opacity" values="0.4;1;0.4" dur="1.5s" repeatCount="indefinite"/>
                        </line>
                    </svg>
                </div>
                <div class="grid grid-cols-3 gap-2 p-4">
                    <div class="rounded-xl overflow-hidden">
                        <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <rect width="100" height="100" fill="#121212"/>
                            <rect x="30" y="30" width="40" height="40" fill="#7CFC00" rx="3"/>
                            <rect x="40" y="40" width="8" height="8" fill="#000"/>
                            <rect x="55" y="40" width="8" height="8" fill="#000"/>
                            <text x="36" y="75" font-family="monospace" font-size="8" fill="#ff00ff" class="glitch-text">#042</text>
                        </svg>
                    </div>
                    <div class="rounded-xl overflow-hidden">
                        <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <rect width="100" height="100" fill="#380036"/>
                            <rect x="30" y="30" width="40" height="40" fill="#7CFC00" rx="3"/>
                            <rect x="40" y="55" width="20" height="3" fill="#000"/>
                            <text x="36" y="75" font-family="monospace" font-size="8" fill="#00ffff" class="glitch-text">#086</text>
                        </svg>
                    </div>
                    <div class="rounded-xl overflow-hidden bg-light-purple flex items-center justify-center">
                        <span class="text-white font-bold">1025+</span>
                    </div>
                </div>
                <div class="p-5 pt-0">
                    <h3 class="text-xl font-bold mb-3">Blockchain Punks</h3>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <svg width="50" height="50" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="25" cy="25" r="25" fill="#380036"/>
                                <rect x="15" y="15" width="20" height="20" fill="#7CFC00" rx="2"/>
                                <rect x="20" y="20" width="4" height="4" fill="#000"/>
                                <rect x="27" y="20" width="4" height="4" fill="#000"/>
                            </svg>
                        </div>
                        <span class="ml-2 text-gray-300">CryptoPunker</span>
                    </div>
                </div>
            </div>
            
            <!-- Collection 3: MetaTokens -->
            <div class="nft-card rounded-2xl overflow-hidden">
                <div class="h-64 overflow-hidden">
                    <svg width="400" height="300" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="tokenGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#000428;stop-opacity:1"/>
                                <stop offset="100%" style="stop-color:#004e92;stop-opacity:1"/>
                            </linearGradient>
                            <filter id="tokenGlow">
                                <feGaussianBlur stdDeviation="3" result="coloredBlur"/>
                                <feMerge>
                                    <feMergeNode in="coloredBlur"/>
                                    <feMergeNode in="SourceGraphic"/>
                                </feMerge>
                            </filter>
                        </defs>
                        <!-- Background -->
                        <rect width="400" height="300" fill="url(#tokenGrad)"/>
                        
                        <!-- Crypto Tokens / Coins -->
                        <g transform="translate(200, 150)">
                            <!-- Central Token with pulsation -->
                            <circle cx="0" cy="0" r="60" fill="#001e3c" stroke="#FFD700" stroke-width="3" filter="url(#tokenGlow)">
                                <animate attributeName="r" values="60;65;60" dur="2s" repeatCount="indefinite"/>
                            </circle>
                            <text x="-40" y="0" font-family="monospace" font-size="12" fill="#FFD700" filter="url(#tokenGlow)" class="glitch-text">META</text>
                            <text x="-40" y="20" font-family="monospace" font-size="10" fill="#FFD700" filter="url(#tokenGlow)" class="glitch-text">TOKEN</text>
                            
                            <!-- Blockchain pattern -->
                            <path d="M-30,-30 L30,-30 L30,30 L-30,30 Z" fill="none" stroke="#FFD700" stroke-width="1" opacity="0.5">
                                <animateTransform attributeName="transform" type="rotate" from="0 0 0" to="360 0 0" dur="10s" repeatCount="indefinite"/>
                            </path>
                            <line x1="-30" y1="-10" x2="30" y2="-10" stroke="#FFD700" stroke-width="1" opacity="0.5"/>
                            <line x1="-30" y1="10" x2="30" y2="10" stroke="#FFD700" stroke-width="1" opacity="0.5"/>
                            <line x1="-10" y1="-30" x2="-10" y2="30" stroke="#FFD700" stroke-width="1" opacity="0.5"/>
                            <line x1="10" y1="-30" x2="10" y2="30" stroke="#FFD700" stroke-width="1" opacity="0.5"/>
                            
                            <!-- Satellite Tokens with orbiting -->
                            <g transform="translate(-90, -50)">
                                <circle cx="0" cy="0" r="25" fill="#001e3c" stroke="#1E90FF" stroke-width="2">
                                    <animateTransform attributeName="transform" type="rotate" from="0 -90 -50" to="360 -90 -50" dur="5s" repeatCount="indefinite"/>
                                </circle>
                                <text x="-13" y="4" font-family="monospace" font-size="8" fill="#1E90FF">BTC</text>
                            </g>
                            <g transform="translate(90, -40)">
                                <circle cx="0" cy="0" r="20" fill="#001e3c" stroke="#32CD32" stroke-width="2">
                                    <animateTransform attributeName="transform" type="rotate" from="360 90 -40" to="0 90 -40" dur="4s" repeatCount="indefinite"/>
                                </circle>
                                <text x="-13" y="4" font-family="monospace" font-size="8" fill="#32CD32">ETH</text>
                            </g>
                            <g transform="translate(-80, 70)">
                                <circle cx="0" cy="0" r="15" fill="#001e3c" stroke="#FF6347" stroke-width="2">
                                    <animateTransform attributeName="transform" type="rotate" from="0 -80 70" to="360 -80 70" dur="6s" repeatCount="indefinite"/>
                                </circle>
                                <text x="-15" y="4" font-family="monospace" font-size="8" fill="#FF6347">SOL</text>
                            </g>
                            <g transform="translate(75, 55)">
                                <circle cx="0" cy="0" r="18" fill="#001e3c" stroke="#FFD700" stroke-width="2">
                                    <animateTransform attributeName="transform" type="rotate" from="360 75 55" to="0 75 55" dur="5.5s" repeatCount="indefinite"/>
                                </circle>
                                <text x="-15" y="4" font-family="monospace" font-size="8" fill="#FFD700">DOT</text>
                            </g>
                            
                            <!-- Connecting Lines with pulsation -->
                            <line x1="0" y1="0" x2="-90" y2="-50" stroke="#1E90FF" stroke-width="1" stroke-dasharray="5,3">
                                <animate attributeName="stroke-opacity" values="0.4;1;0.4" dur="1.5s" repeatCount="indefinite"/>
                            </line>
                            <line x1="0" y1="0" x2="90" y2="-40" stroke="#32CD32" stroke-width="1" stroke-dasharray="5,3">
                                <animate attributeName="stroke-opacity" values="0.4;1;0.4" dur="1.5s" repeatCount="indefinite"/>
                            </line>
                            <line x1="0" y1="0" x2="-80" y2="70" stroke="#FF6347" stroke-width="1" stroke-dasharray="5,3">
                                <animate attributeName="stroke-opacity" values="0.4;1;0.4" dur="1.5s" repeatCount="indefinite"/>
                            </line>
                            <line x1="0" y1="0" x2="75" y2="55" stroke="#FFD700" stroke-width="1" stroke-dasharray="5,3">
                                <animate attributeName="stroke-opacity" values="0.4;1;0.4" dur="1.5s" repeatCount="indefinite"/>
                            </line>
                            
                            <!-- Animated Hash/Transaction Data -->
                            <text x="-170" y="120" font-family="monospace" font-size="8" fill="white" opacity="0.7" class="glitch-text">
                                0x7F4e2D3a1B...
                                <animate attributeName="y" from="120" to="150" dur="4s" repeatCount="indefinite"/>
                                <animate attributeName="opacity" from="0.7" to="0" dur="4s" repeatCount="indefinite"/>
                            </text>
                            <text x="80" y="120" font-family="monospace" font-size="8" fill="white" opacity="0.7" class="glitch-text">
                                0x3A8f1E9c2D...
                                <animate attributeName="y" from="120" to="90" dur="4s" repeatCount="indefinite"/>
                                <animate attributeName="opacity" from="0.7" to="0" dur="4s" repeatCount="indefinite"/>
                            </text>
                        </g>
                    </svg>
                </div>
                <div class="grid grid-cols-3 gap-2 p-4">
                    <div class="rounded-xl overflow-hidden">
                        <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <rect width="100" height="100" fill="#000428"/>
                            <circle cx="50" cy="50" r="30" fill="#001e3c" stroke="#FFD700" stroke-width="2">
                                <animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="6s" repeatCount="indefinite"/>
                            </circle>
                            <text x="35" y="45" font-family="monospace" font-size="8" fill="#FFD700" class="glitch-text">META</text>
                            <text x="35" y="55" font-family="monospace" font-size="6" fill="#FFD700" class="glitch-text">#721</text>
                        </svg>
                    </div>
                    <div class="rounded-xl overflow-hidden">
                        <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <rect width="100" height="100" fill="#004e92"/>
                            <circle cx="50" cy="50" r="30" fill="#001e3c" stroke="#1E90FF" stroke-width="2">
                                <animateTransform attributeName="transform" type="rotate" from="360 50 50" to="0 50 50" dur="6s" repeatCount="indefinite"/>
                            </circle>
                            <text x="35" y="45" font-family="monospace" font-size="8" fill="#1E90FF" class="glitch-text">META</text>
                            <text x="35" y="55" font-family="monospace" font-size="6" fill="#1E90FF" class="glitch-text">#394</text>
                        </svg>
                    </div>
                    <div class="rounded-xl overflow-hidden bg-light-purple flex items-center justify-center">
                        <span class="text-white font-bold">1025+</span>
                    </div>
                </div>
                <div class="p-5 pt-0">
                    <h3 class="text-xl font-bold mb-3">MetaTokens</h3>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <svg width="50" height="50" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="25" cy="25" r="25" fill="#001e3c"/>
                                <text x="11" y="30" font-family="monospace" font-size="10" fill="#FFD700" class="glitch-text">MTK</text>
                            </svg>
                        </div>
                        <span class="ml-2 text-gray-300">TokenMaster</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>