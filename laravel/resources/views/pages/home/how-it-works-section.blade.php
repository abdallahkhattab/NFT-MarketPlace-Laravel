<section class="py-10 px-6 md:px-10" style="background-color: #060B27;">
    <div class="container mx-auto">
        <div class="mb-10">
            <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-purple-600 neon-flicker" style="text-shadow: 0 0 15px rgba(56, 189, 248, 0.5);">How It Works</h2>
            <p class="text-cyan-400 mt-2 typewriter" style="animation: typing 2s steps(30, end) forwards;">Find Out How To Get Started</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Step 1: Setup Wallet -->
            <div class="relative bg-gradient-to-b from-gray-900 to-gray-800 rounded-2xl p-8 border border-cyan-500/30 holographic-card" style="box-shadow: 0 0 20px rgba(6, 182, 212, 0.2); animation: materialize 0.8s ease-out forwards; animation-delay: 0s;">
                <div class="absolute -top-3 -right-3 bg-gradient-to-br from-cyan-500 to-purple-600 rounded-full w-10 h-10 flex items-center justify-center text-lg font-bold pulse-node" style="box-shadow: 0 0 10px rgba(6, 182, 212, 0.5);">1</div>
                <div class="w-32 h-32 rounded-full bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center mb-6 mx-auto svg-container" style="box-shadow: inset 0 0 30px rgba(6, 182, 212, 0.3), 0 0 20px rgba(6, 182, 212, 0.2);">
                    <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="walletGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#06b6d4;stop-opacity:1"/>
                                <stop offset="100%" style="stop-color:#a855f7;stop-opacity:1"/>
                            </linearGradient>
                            <filter id="walletGlow">
                                <feGaussianBlur stdDeviation="1.5" result="coloredBlur"/>
                                <feMerge>
                                    <feMergeNode in="coloredBlur"/>
                                    <feMergeNode in="SourceGraphic"/>
                                </feMerge>
                            </filter>
                        </defs>
                        <!-- Digital Wallet -->
                        <rect class="wallet-frame" x="15" y="25" width="70" height="50" rx="5" fill="#1e293b" stroke="url(#walletGrad)" stroke-width="2" filter="url(#walletGlow)"/>
                        <!-- Wallet Screen -->
                        <rect x="20" y="30" width="60" height="25" rx="2" fill="#0f172a" stroke="#06b6d4" stroke-width="1"/>
                        <!-- Wallet Content -->
                        <text x="25" y="40" font-family="monospace" font-size="5" fill="#06b6d4">BALANCE</text>
                        <text x="25" y="48" font-family="monospace" font-size="6" fill="#a855f7" font-weight="bold">3.712 ETH</text>
                        <!-- Connection Lines -->
                        <path class="connection-line" d="M65 42 L80 42 L85 47 L85 52 L80 57 L70 57" fill="none" stroke="#06b6d4" stroke-width="1" stroke-dasharray="2,1" filter="url(#walletGlow)">
                            <animate attributeName="stroke-dashoffset" from="100" to="0" dur="2s" repeatCount="indefinite"/>
                        </path>
                        <circle cx="70" cy="57" r="2" fill="#06b6d4" filter="url(#walletGlow)">
                            <animate attributeName="opacity" values="1;0.5;1" dur="1.5s" repeatCount="indefinite"/>
                        </circle>
                        <!-- Wallet Keys -->
                        <rect class="wallet-key" x="25" y="60" width="10" height="10" rx="2" fill="#0f172a" stroke="#06b6d4" stroke-width="1">
                            <animateTransform attributeName="transform" type="scale" values="1;1.1;1" dur="2s" repeatCount="indefinite" additive="sum"/>
                        </rect>
                        <rect class="wallet-key" x="45" y="60" width="10" height="10" rx="2" fill="#0f172a" stroke="#06b6d4" stroke-width="1">
                            <animateTransform attributeName="transform" type="scale" values="1;1.1;1" dur="2s" repeatCount="indefinite" begin="0.2s" additive="sum"/>
                        </rect>
                        <rect class="wallet-key" x="65" y="60" width="10" height="10" rx="2" fill="#0f172a" stroke="#06b6d4" stroke-width="1">
                            <animateTransform attributeName="transform" type="scale" values="1;1.1;1" dur="2s" repeatCount="indefinite" begin="0.4s" additive="sum"/>
                        </rect>
                        <!-- Key Letters -->
                        <text x="27" y="67" font-family="monospace" font-size="6" fill="#06b6d4">A</text>
                        <text x="47" y="67" font-family="monospace" font-size="6" fill="#06b6d4">B</text>
                        <text x="67" y="67" font-family="monospace" font-size="6" fill="#06b6d4">C</text>
                        <!-- Connection Waves -->
                        <path class="wave-line" d="M85 30 Q90 35, 85 40 Q80 45, 85 50" fill="none" stroke="#a855f7" stroke-width="1" filter="url(#walletGlow)">
                            <animate attributeName="stroke-dashoffset" from="50" to="0" dur="1.5s" repeatCount="indefinite"/>
                        </path>
                        <path class="wave-line" d="M87 30 Q92 35, 87 40 Q82 45, 87 50" fill="none" stroke="#a855f7" stroke-width="0.5" filter="url(#walletGlow)">
                            <animate attributeName="stroke-dashoffset" from="50" to="0" dur="1.5s" repeatCount="indefinite"/>
                        </path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-center text-white" style="text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);">Setup Your Wallet</h3>
                <p class="text-cyan-100/70 text-center">Connect your preferred crypto wallet to access the blockchain network. Secure your private keys and enable seamless transactions.</p>
                <div class="mt-5 flex justify-center">
                    <div class="text-xs px-3 py-1 bg-cyan-950/50 text-cyan-400 rounded-full border border-cyan-500/30 tag-pulse" style="font-family: monospace;">0xWallet_Connection</div>
                </div>
            </div>
            
            <!-- Step 2: Create Collection -->
            <div class="relative bg-gradient-to-b from-gray-900 to-gray-800 rounded-2xl p-8 border border-purple-500/30 holographic-card" style="box-shadow: 0 0 20px rgba(168, 85, 247, 0.2); animation: materialize 0.8s ease-out forwards; animation-delay: 0.2s;">
                <div class="absolute -top-3 -right-3 bg-gradient-to-br from-cyan-500 to-purple-600 rounded-full w-10 h-10 flex items-center justify-center text-lg font-bold pulse-node" style="box-shadow: 0 0 10px rgba(168, 85, 247, 0.5);">2</div>
                <div class="w-32 h-32 rounded-full bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center mb-6 mx-auto svg-container" style="box-shadow: inset 0 0 30px rgba(168, 85, 247, 0.3), 0 0 20px rgba(168, 85, 247, 0.2);">
                    <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="collectionGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#06b6d4;stop-opacity:1"/>
                                <stop offset="100%" style="stop-color:#a855f7;stop-opacity:1"/>
                            </linearGradient>
                            <filter id="collectionGlow">
                                <feGaussianBlur stdDeviation="1.5" result="coloredBlur"/>
                                <feMerge>
                                    <feMergeNode in="coloredBlur"/>
                                    <feMergeNode in="SourceGraphic"/>
                                </feMerge>
                            </filter>
                            <pattern id="gridPattern" width="5" height="5" patternUnits="userSpaceOnUse">
                                <rect width="5" height="5" fill="none" stroke="#a855f7" stroke-width="0.5" opacity="0.3"/>
                            </pattern>
                        </defs>
                        <!-- Collection Frame -->
                        <rect class="collection-frame" x="20" y="20" width="60" height="60" rx="5" fill="#1e293b" stroke="url(#collectionGrad)" stroke-width="2" filter="url(#collectionGlow)"/>
                        <!-- NFT Artwork -->
                        <rect class="artwork" x="25" y="25" width="50" height="40" rx="3" fill="#0f172a" stroke="#a855f7" stroke-width="1"/>
                        <rect class="artwork" x="25" y="25" width="50" height="40" rx="3" fill="url(#gridPattern)"/>
                        <!-- Stylized Art Elements -->
                        <rect class="art-element" x="35" y="35" width="15" height="15" rx="2" fill="#06b6d4" opacity="0.7"/>
                        <circle class="art-element" cx="60" cy="40" r="8" fill="#a855f7" opacity="0.7"/>
                        <path class="art-element" d="M40 55 L55 45 L65 52" fill="none" stroke="#06b6d4" stroke-width="2" filter="url(#collectionGlow)">
                            <animate attributeName="stroke-dashoffset" from="50" to="0" dur="1.5s" repeatCount="indefinite"/>
                        </path>
                        <!-- Collection Details -->
                        <rect x="25" y="70" width="20" height="5" rx="1" fill="#0f172a" stroke="#06b6d4" stroke-width="0.5"/>
                        <rect x="55" y="70" width="20" height="5" rx="1" fill="#0f172a" stroke="#06b6d4" stroke-width="0.5"/>
                        <!-- Upload Icon -->
                        <circle class="upload-icon" cx="75" cy="30" r="5" fill="#0f172a" stroke="#a855f7" stroke-width="1">
                            <animateTransform attributeName="transform" type="scale" values="1;1.2;1" dur="2s" repeatCount="indefinite"/>
                        </circle>
                        <line x1="75" y1="28" x2="75" y2="32" stroke="#a855f7" stroke-width="1"/>
                        <line x1="73" y1="30" x2="77" y2="30" stroke="#a855f7" stroke-width="1"/>
                        <!-- Token ID -->
                        <text x="28" y="63" font-family="monospace" font-size="4" fill="#a855f7" filter="url(#collectionGlow)">#NFT_8531</text>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-center text-white" style="text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);">Create Collection</h3>
                <p class="text-purple-100/70 text-center">Upload your digital assets and mint them as NFTs. Define metadata, set royalties, and organize your collection on the blockchain.</p>
                <div class="mt-5 flex justify-center">
                    <div class="text-xs px-3 py-1 bg-purple-950/50 text-purple-400 rounded-full border border-purple-500/30 tag-pulse" style="font-family: monospace;">0xNFT_Creation</div>
                </div>
            </div>
            
            <!-- Step 3: Start Earning -->
            <div class="relative bg-gradient-to-b from-gray-900 to-gray-800 rounded-2xl p-8 border border-blue-500/30 holographic-card" style="box-shadow: 0 0 20px rgba(59, 130, 246, 0.2); animation: materialize 0.8s ease-out forwards; animation-delay: 0.4s;">
                <div class="absolute -top-3 -right-3 bg-gradient-to-br from-cyan-500 to-purple-600 rounded-full w-10 h-10 flex items-center justify-center text-lg font-bold pulse-node" style="box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);">3</div>
                <div class="w-32 h-32 rounded-full bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center mb-6 mx-auto svg-container" style="box-shadow: inset 0 0 30px rgba(59, 130, 246, 0.3), 0 0 20px rgba(59, 130, 246, 0.2);">
                    <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="earningGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#06b6d4;stop-opacity:1"/>
                                <stop offset="100%" style="stop-color:#a855f7;stop-opacity:1"/>
                            </linearGradient>
                            <filter id="earningGlow">
                                <feGaussianBlur stdDeviation="1.5" result="coloredBlur"/>
                                <feMerge>
                                    <feMergeNode in="coloredBlur"/>
                                    <feMergeNode in="SourceGraphic"/>
                                </feMerge>
                            </filter>
                        </defs>
                        <!-- Crypto Token/Coin -->
                        <circle class="coin" cx="50" cy="50" r="30" fill="#1e293b" stroke="url(#earningGrad)" stroke-width="2" filter="url(#earningGlow)">
                            <animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="10s" repeatCount="indefinite"/>
                        </circle>
                        <!-- Ethereum Symbol -->
                        <path class="eth-symbol" d="M50 25 L50 55 L30 43 Z" fill="#06b6d4" opacity="0.8" filter="url(#earningGlow)"/>
                        <path class="eth-symbol" d="M50 25 L50 55 L70 43 Z" fill="#a855f7" opacity="0.8" filter="url(#earningGlow)"/>
                        <path class="eth-symbol" d="M50 75 L50 58 L30 43 Z" fill="#3b82f6" opacity="0.6"/>
                        <path class="eth-symbol" d="M50 75 L50 58 L70 43 Z" fill="#3b82f6" opacity="0.6"/>
                        <!-- Chart Lines -->
                        <path class="chart-line" d="M15 80 L25 75 L35 78 L45 65 L55 70 L65 60 L75 65 L85 55" fill="none" stroke="#06b6d4" stroke-width="1.5" filter="url(#earningGlow)">
                            <animate attributeName="stroke-dashoffset" from="100" to="0" dur="2s" repeatCount="indefinite"/>
                        </path>
                        <!-- Price Indicators -->
                        <circle cx="25" cy="75" r="2" fill="#06b6d4" filter="url(#earningGlow)">
                            <animate attributeName="opacity" values="1;0.5;1" dur="2s" repeatCount="indefinite"/>
                        </circle>
                        <circle cx="45" cy="65" r="2" fill="#06b6d4" filter="url(#earningGlow)">
                            <animate attributeName="opacity" values="1;0.5;1" dur="2s" repeatCount="indefinite" begin="0.2s"/>
                        </circle>
                        <circle cx="65" cy="60" r="2" fill="#06b6d4" filter="url(#earningGlow)">
                            <animate attributeName="opacity" values="1;0.5;1" dur="2s" repeatCount="indefinite" begin="0.4s"/>
                        </circle>
                        <circle cx="85" cy="55" r="2" fill="#06b6d4" filter="url(#earningGlow)">
                            <animate attributeName="opacity" values="1;0.5;1" dur="2s" repeatCount="indefinite" begin="0.6s"/>
                        </circle>
                        <!-- Transaction Lines -->
                        <line class="tx-line" x1="20" y1="30" x2="35" y2="35" stroke="#a855f7" stroke-width="0.5" stroke-dasharray="2,1">
                            <animate attributeName="opacity" values="1;0.5;1" dur="1.5s" repeatCount="indefinite"/>
                        </line>
                        <line class="tx-line" x1="20" y1="45" x2="30" y2="43" stroke="#a855f7" stroke-width="0.5" stroke-dasharray="2,1">
                            <animate attributeName="opacity" values="1;0.5;1" dur="1.5s" repeatCount="indefinite" begin="0.2s"/>
                        </line>
                        <line class="tx-line" x1="80" y1="30" x2="65" y2="35" stroke="#a855f7" stroke-width="0.5" stroke-dasharray="2,1">
                            <animate attributeName="opacity" values="1;0.5;1" dur="1.5s" repeatCount="indefinite" begin="0.4s"/>
                        </line>
                        <line class="tx-line" x1="80" y1="45" x2="70" y2="43" stroke="#a855f7" stroke-width="0.5" stroke-dasharray="2,1">
                            <animate attributeName="opacity" values="1;0.5;1" dur="1.5s" repeatCount="indefinite" begin="0.6s"/>
                        </line>
                        <!-- Transaction Hash -->
                        <text x="15" y="20" font-family="monospace" font-size="3" fill="#06b6d4">0xb731...f29d</text>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-center text-white" style="text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);">Start Earning</h3>
                <p class="text-blue-100/70 text-center">List your NFTs on the marketplace for auction or fixed price. Receive royalties from secondary sales through smart contracts.</p>
                <div class="mt-5 flex justify-center">
                    <div class="text-xs px-3 py-1 bg-blue-950/50 text-blue-400 rounded-full border border-blue-500/30 tag-pulse" style="font-family: monospace;">0xSmart_Contract</div>
                </div>
            </div>
        </div>
        
        <!-- Blockchain Connection Lines -->
        <div class="relative mt-6 mx-auto w-full max-w-4xl h-12 hidden md:block connection-lines">
            <svg width="100%" height="100%" viewBox="0 0 800 50" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="lineGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#06b6d4;stop-opacity:1"/>
                        <stop offset="50%" style="stop-color:#a855f7;stop-opacity:1"/>
                        <stop offset="100%" style="stop-color:#3b82f6;stop-opacity:1"/>
                    </linearGradient>
                    <filter id="lineGlow">
                        <feGaussianBlur stdDeviation="1" result="coloredBlur"/>
                        <feMerge>
                            <feMergeNode in="coloredBlur"/>
                            <feMergeNode in="SourceGraphic"/>
                        </feMerge>
                    </filter>
                </defs>
                <path class="connection-path" d="M100 25 L350 25" stroke="url(#lineGrad)" stroke-width="2" stroke-dasharray="10,5" opacity="0.7" filter="url(#lineGlow)">
                    <animate attributeName="stroke-dashoffset" from="15" to="0" dur="2s" repeatCount="indefinite"/>
                </path>
                <path class="connection-path" d="M450 25 L700 25" stroke="url(#lineGrad)" stroke-width="2" stroke-dasharray="10,5" opacity="0.7" filter="url(#lineGlow)">
                    <animate attributeName="stroke-dashoffset" from="15" to="0" dur="2s" repeatCount="indefinite"/>
                </path>
                <circle cx="100" cy="25" r="5" fill="#06b6d4" filter="url(#lineGlow)">
                    <animate attributeName="r" values="5;6;5" dur="2s" repeatCount="indefinite"/>
                </circle>
                <circle cx="350" cy="25" r="5" fill="#a855f7" filter="url(#lineGlow)">
                    <animate attributeName="r" values="5;6;5" dur="2s" repeatCount="indefinite"/>
                </circle>
                <circle cx="450" cy="25" r="5" fill="#a855f7" filter="url(#lineGlow)">
                    <animate attributeName="r" values="5;6;5" dur="2s" repeatCount="indefinite"/>
                </circle>
                <circle cx="700" cy="25" r="5" fill="#3b82f6" filter="url(#lineGlow)">
                    <animate attributeName="r" values="5;6;5" dur="2s" repeatCount="indefinite"/>
                </circle>
                <!-- Data Packets -->
                <circle class="data-packet" cx="100" cy="25" r="3" fill="#06b6d4" filter="url(#lineGlow)">
                    <animateMotion dur="2s" repeatCount="indefinite" path="M100 25 L350 25"/>
                </circle>
                <circle class="data-packet" cx="450" cy="25" r="3" fill="#a855f7" filter="url(#lineGlow)">
                    <animateMotion dur="2s" repeatCount="indefinite" path="M450 25 L700 25"/>
                </circle>
                <!-- Transaction Points -->
                <circle cx="175" cy="25" r="2" fill="#06b6d4" filter="url(#lineGlow)">
                    <animate attributeName="opacity" values="1;0.3;1" dur="3s" repeatCount="indefinite"/>
                </circle>
                <circle cx="275" cy="25" r="2" fill="#a855f7" filter="url(#lineGlow)">
                    <animate attributeName="opacity" values="0.3;1;0.3" dur="3s" repeatCount="indefinite"/>
                </circle>
                <circle cx="525" cy="25" r="2" fill="#a855f7" filter="url(#lineGlow)">
                    <animate attributeName="opacity" values="1;0.3;1" dur="4s" repeatCount="indefinite"/>
                </circle>
                <circle cx="625" cy="25" r="2" fill="#3b82f6" filter="url(#lineGlow)">
                    <animate attributeName="opacity" values="0.3;1;0.3" dur="4s" repeatCount="indefinite"/>
                </circle>
            </svg>
        </div>
        
        <!-- Digital Asset Flow Animation -->
        <div class="mt-10 text-center relative">
            <div class="particle-flow" id="particle-flow"></div>
            <span class="inline-block px-4 py-2 bg-gradient-to-r from-cyan-900/30 to-purple-900/30 text-cyan-400 rounded-lg border border-cyan-500/30 text-cycle" style="font-family: monospace; letter-spacing: 1px; text-shadow: 0 0 5px rgba(6, 182, 212, 0.5);"></span>
        </div>
    </div>

    <!-- Styles -->
    <style>
        /* Neon Flicker for Title */
        .neon-flicker {
            animation: neonFlicker 2s ease-out forwards;
        }
        @keyframes neonFlicker {
            0% { opacity: 0; text-shadow: none; transform: translateY(10px); }
            50% { opacity: 0.7; text-shadow: 0 0 10px rgba(56, 189, 248, 0.3); }
            70% { opacity: 0.9; transform: translateY(-2px); }
            80% { opacity: 0.8; }
            100% { opacity: 1; transform: translateY(0); text-shadow: 0 0 15px rgba(56, 189, 248, 0.5); }
        }

        /* Typewriter Effect */
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

        /* Materialize Animation for Cards */
        .holographic-card {
            opacity: 0;
            animation: pulseGlow 3s infinite;
        }
        @keyframes materialize {
            0% { opacity: 0; transform: translateY(20px) scale(0.9); }
            50% { opacity: 0.6; transform: translateY(0) scale(1.02); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(6, 182, 212, 0.2); }
            50% { box-shadow: 0 0 30px rgba(6, 182, 212, 0.4); }
        }

        /* Pulse Node for Step Numbers */
        .pulse-node {
            animation: nodePulse 2s ease-in-out infinite;
        }
        @keyframes nodePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* SVG Hover Effects */
        .svg-container {
            transition: transform 0.3s ease;
        }
        .svg-container:hover {
            transform: scale(1.1);
        }
        .svg-container:hover .wallet-frame,
        .svg-container:hover .collection-frame,
        .svg-container:hover .coin {
            filter: url(#walletGlow) brightness(1.2);
        }
        .svg-container:hover .wallet-key {
            animation: keyPulse 0.5s ease-in-out;
        }
        .svg-container:hover .art-element {
            animation: artReveal 0.5s ease-in-out;
        }
        .svg-container:hover .chart-line {
            animation: chartSpike 0.5s ease-in-out;
        }
        @keyframes keyPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }
        @keyframes artReveal {
            0% { opacity: 0.7; transform: scale(0.8); }
            100% { opacity: 1; transform: scale(1); }
        }
        @keyframes chartSpike {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }

        /* Tag Pulse Effect */
        .tag-pulse {
            position: relative;
            transition: all 0.3s ease;
        }
        .tag-pulse:hover::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(6, 182, 212, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: ripple 0.5s ease-out;
        }
        @keyframes ripple {
            0% { width: 0; height: 0; opacity: 0.5; }
            100% { width: 100px; height: 100px; opacity: 0; }
        }

        /* Particle Flow */
        .particle-flow {
            position: absolute;
            top: -20px;
            left: 0;
            width: 100%;
            height: 60px;
            pointer-events: none;
        }
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #06b6d4;
            border-radius: 50%;
            animation: dataFlow 3s infinite ease-in-out;
            opacity: 0;
        }
        .particle:nth-child(odd) {
            background: #a855f7;
        }
        @keyframes dataFlow {
            0% { transform: translateY(0) scale(0.5); opacity: 0; }
            20% { opacity: 0.8; transform: translateY(-20px) scale(1); }
            100% { transform: translateY(-40px) scale(0.5); opacity: 0; }
        }
    </style>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create Particles
            function createParticles() {
                const particleFlow = document.getElementById('particle-flow');
                for (let i = 0; i < 20; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.animationDelay = `${Math.random() * 3}s`;
                    particleFlow.appendChild(particle);
                }
            }

            // Text Cycling
            const phrases = [
                'Start Your NFT Journey',
                'Blockchain Verified',
                'Web3 Enabled'
            ];
            let currentPhrase = 0;
            const textElement = document.querySelector('.text-cycle');
            function cycleText() {
                textElement.textContent = phrases[currentPhrase];
                gsap.fromTo(textElement, 
                    { opacity: 0, x: 10 }, 
                    { opacity: 1, x: 0, duration: 0.5, ease: 'power2.out', 
                      onComplete: () => {
                          setTimeout(() => {
                              gsap.to(textElement, {
                                  opacity: 0, x: -10, duration: 0.5, ease: 'power2.out',
                                  onComplete: () => {
                                      currentPhrase = (currentPhrase + 1) % phrases.length;
                                      cycleText();
                                  }
                              });
                          }, 2000);
                      }
                    }
                );
            }

            // Scroll-Triggered Animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        gsap.to(entry.target.querySelectorAll('.holographic-card'), {
                            opacity: 1,
                            duration: 0.8,
                            stagger: 0.2
                        });
                        gsap.to('.connection-lines', {
                            opacity: 1,
                            duration: 1,
                            delay: 0.5
                        });
                    }
                });
            }, { threshold: 0.2 });
            observer.observe(document.querySelector('.grid'));

            // Hover Effects for Cards
            const cards = document.querySelectorAll('.holographic-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    gsap.to(card, {
                        scale: 1.05,
                        boxShadow: '0 0 40px rgba(6, 182, 212, 0.5)',
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });
                card.addEventListener('mouseleave', () => {
                    gsap.to(card, {
                        scale: 1,
                        boxShadow: '0 0 20px rgba(6, 182, 212, 0.2)',
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });
            });

            // Initialize
            createParticles();
            cycleText();
        });
    </script>
</section>