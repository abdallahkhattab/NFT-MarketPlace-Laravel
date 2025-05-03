@extends('layouts.layout')

@section('title', 'Connect Wallet')

@push('styles')
    <style>
        /* Custom Keyframes */
        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 10px rgba(79, 70, 229, 0.5), 0 0 20px rgba(236, 72, 153, 0.3);
            }

            50% {
                box-shadow: 0 0 20px rgba(79, 70, 229, 0.8), 0 0 40px rgba(236, 72, 153, 0.5);
            }
        }

        @keyframes zoom {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes border-pulse {

            0%,
            100% {
                border-color: #a259ff;
            }

            50% {
                border-color: #8e42f5;
            }
        }

        @keyframes star-twinkle {

            0%,
            100% {
                opacity: 0.2;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.5);
            }
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

        .wallet-button .star-particle:nth-child(1) {
            top: 10%;
            left: 20%;
            animation-delay: 0s;
        }

        .wallet-button .star-particle:nth-child(2) {
            top: 30%;
            left: 60%;
            animation-delay: 0.3s;
        }

        .wallet-button .star-particle:nth-child(3) {
            top: 70%;
            left: 30%;
            animation-delay: 0.6s;
        }

        .wallet-button .star-particle:nth-child(4) {
            top: 50%;
            left: 80%;
            animation-delay: 0.9s;
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-dark flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Side: Image Section -->
            <div x-data="{ isHovered: false }" @mousemove="isHovered = true" @mouseleave="isHovered = false"
                class="relative h-96 lg:h-[600px] rounded-2xl overflow-hidden nft-container animate-pulse-glow"
                x-init="initNFTContainer($el)">
                <img src="{{ asset('assets/nft_images/register-image.png') }}" alt="NFT Space Scene"
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
                    <button
                        class="wallet-button w-full flex items-center justify-between text-white py-4 px-6 rounded-xl transition-all"
                        id="metamask-btn">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/wallet/Metamask.png') }}" alt="MetaMask Icon" class="w-8 h-8 mr-4">
                            <span class="text-lg font-semibold">MetaMask</span>
                        </div>
                    </button>

                    <!-- Wallet Connect -->
                    <button
                        class="wallet-button w-full flex items-center justify-between text-white py-4 px-6 rounded-xl transition-all"
                        id="walletconnect-btn">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/wallet/WalletConnect.png') }}" alt="Wallet Connect Icon"
                                class="w-8 h-8 mr-4">
                            <span class="text-lg font-semibold">Wallet Connect</span>
                        </div>
                    </button>

                    <!-- Coinbase -->
                    <button
                        class="wallet-button w-full flex items-center justify-between text-white py-4 px-6 rounded-xl transition-all"
                        id="coinbase-btn">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/wallet/Coinbase.png') }}" alt="Coinbase Icon" class="w-8 h-8 mr-4">
                            <span class="text-lg font-semibold">Coinbase</span>
                        </div>
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
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Initialize wallet buttons
        document.addEventListener('DOMContentLoaded', function() {
            const metamaskBtn = document.getElementById('metamask-btn');
            const walletconnectBtn = document.getElementById('walletconnect-btn');
            const coinbaseBtn = document.getElementById('coinbase-btn');

            if (metamaskBtn) metamaskBtn.addEventListener('click', () => connectWallet('metamask'));
            if (walletconnectBtn) walletconnectBtn.addEventListener('click', () => connectWallet('walletconnect'));
            if (coinbaseBtn) coinbaseBtn.addEventListener('click', () => connectWallet('coinbase'));

            // Check if user already has a connected wallet
            checkWalletConnection();
        });

        // Store wallet connection state
        const walletState = {
            connected: false,
            address: null,
            type: null,
            chainId: null
        };

        /**
         * Check if user has a connected wallet
         */
        async function checkWalletConnection() {
            if (window.ethereum) {
                try {
                    const accounts = await ethereum.request({
                        method: 'eth_accounts'
                    });

                    if (accounts.length > 0) {
                        const chainId = await ethereum.request({
                            method: 'eth_chainId'
                        });
                        updateWalletState('metamask', accounts[0], chainId);
                        updateConnectedUI(accounts[0], 'metamask');
                    }
                } catch (err) {
                    console.error('Error checking connection:', err);
                }
            }
        }

        /**
         * Connect to selected wallet
         */
        async function connectWallet(walletType) {
            showLoadingState(walletType);

            try {
                let walletAddress;
                let chainId;

                if (walletType === 'metamask') {
                    if (typeof window.ethereum !== 'undefined') {
                        const accounts = await ethereum.request({
                            method: 'eth_requestAccounts'
                        });

                        walletAddress = accounts[0];
                        chainId = await ethereum.request({
                            method: 'eth_chainId'
                        });

                        const desiredChainId = '0x1'; // Ethereum Mainnet
                        if (chainId !== desiredChainId) {
                            await switchNetwork(desiredChainId);
                            chainId = desiredChainId;
                        }

                        updateWalletState('metamask', walletAddress, chainId);
                        await authenticateWallet(walletAddress, walletType);
                    } else {
                        hideLoadingState(walletType);
                        showWalletNotInstalledError('MetaMask');
                    }
                } else if (walletType === 'walletconnect') {
                    hideLoadingState(walletType);
                    alert('WalletConnect integration coming soon!');
                } else if (walletType === 'coinbase') {
                    hideLoadingState(walletType);
                    alert('Coinbase Wallet integration coming soon!');
                }
            } catch (error) {
                hideLoadingState(walletType);
                console.error('Error connecting to wallet:', error);
                showErrorMessage('Failed to connect wallet. Please try again.');
            }
        }

        /**
         * Switch to desired network
         */
        async function switchNetwork(chainId) {
            try {
                await ethereum.request({
                    method: 'wallet_switchEthereumChain',
                    params: [{
                        chainId
                    }],
                });
            } catch (switchError) {
                if (switchError.code === 4902) {
                    try {
                        await ethereum.request({
                            method: 'wallet_addEthereumChain',
                            params: [{
                                chainId: chainId,
                                chainName: chainId === '0x1' ? 'Ethereum Mainnet' : 'Test Network',
                                nativeCurrency: {
                                    name: 'Ether',
                                    symbol: 'ETH',
                                    decimals: 18
                                },
                                rpcUrls: [chainId === '0x1' ?
                                    'https://mainnet.infura.io/v3/YOUR_INFURA_KEY' :
                                    'https://rinkeby.infura.io/v3/YOUR_INFURA_KEY'
                                ],
                                blockExplorerUrls: [chainId === '0x1' ? 'https://etherscan.io' :
                                    'https://rinkeby.etherscan.io'
                                ]
                            }]
                        });
                    } catch (addError) {
                        throw new Error('Could not add or switch to the network');
                    }
                } else {
                    throw switchError;
                }
            }
        }

        /**
         * Update internal wallet state
         */
        function updateWalletState(walletType, address, chainId) {
            walletState.connected = true;
            walletState.address = address;
            walletState.type = walletType;
            walletState.chainId = chainId;

            localStorage.setItem('walletState', JSON.stringify(walletState));
        }

        /**
         * Authenticate wallet with backend
         */
        async function authenticateWallet(walletAddress, walletType) {
            try {
                console.log('Fetching nonce for:', {
                    walletAddress,
                    walletType
                });
                const nonceResponse = await fetch('/get-nonce', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        wallet_address: walletAddress,
                        wallet_type: walletType
                    })
                });

                const nonceData = await nonceResponse.json();
                console.log('Nonce response:', nonceData);

                if (!nonceData.nonce) {
                    throw new Error('Failed to get authentication nonce');
                }

                const signature = await signMessage(nonceData.nonce, walletType);
                console.log('Signature created:', signature);

                if (nonceData.wallet_exists === false) {
                    hideLoadingState(walletType);
                    showRegistrationForm(walletAddress, walletType, signature);
                    return;
                }

                await verifySignature(walletAddress, signature, walletType);
            } catch (error) {
                hideLoadingState(walletType);
                console.error('Error during authentication:', error);
                showErrorMessage('Authentication failed: ' + error.message);
            }
        }

        /**
         * Sign message using wallet
         */
        async function signMessage(message, walletType) {
            if (walletType === 'metamask') {
                try {
                    const from = walletState.address;
                    const signature = await ethereum.request({
                        method: 'personal_sign',
                        params: [message, from]
                    });
                    console.log('Signed message:', message, 'Signature:', signature);
                    return signature;
                } catch (error) {
                    console.error('Error signing message:', error);
                    throw new Error('User rejected message signature');
                }
            } else {
                throw new Error(`Signing with ${walletType} not implemented yet`);
            }
        }

        /**
         * Send signature to backend for verification
         */
        async function verifySignature(walletAddress, signature, walletType, name = null, email = null) {
            try {
                showLoadingMessage('Verifying signature...');

                console.log('Verifying signature:', {
                    walletAddress,
                    signature,
                    walletType,
                    name,
                    email
                });

                const response = await fetch('/authenticate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        wallet_address: walletAddress,
                        signature: signature,
                        wallet_type: walletType,
                        name: name,
                        email: email
                    })
                });

                const data = await response.json();
                console.log('Authenticate response:', data);

                if (data.success) {
                    updateConnectedUI(walletAddress, walletType);
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                } else if (data.registration_required) {
                    showRegistrationForm(walletAddress, walletType, signature);
                } else if (data.retry && data.new_nonce) {
                    console.log('Retrying with new nonce:', data.new_nonce);
                    const newSignature = await signMessage(data.new_nonce, walletType);
                    await verifySignature(walletAddress, newSignature, walletType, name, email);
                } else {
                    throw new Error(data.error || 'Authentication failed');
                }
            } catch (error) {
                console.error('Error verifying signature:', error);
                showErrorMessage('Verification failed: ' + error.message);
            } finally {
                hideLoadingMessage();
            }
        }

        /**
         * Show registration form for new users
         */
        function showRegistrationForm(walletAddress, walletType, signature) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            modal.id = 'registration-modal';

            const shortAddress = walletAddress.substr(0, 6) + '...' + walletAddress.substr(-4);

            modal.innerHTML = `
        <div class="bg-darker rounded-xl p-8 max-w-md w-full">
            <h3 class="text-2xl font-bold text-white mb-4">Complete Registration</h3>
            <p class="text-gray-400 mb-6">Please provide the following details to complete your account setup.</p>
            
            <form id="registration-form" class="space-y-4">
                <div>
                    <label class="block text-white text-sm font-medium mb-2">Connected Wallet</label>
                    <div class="bg-gray-800 rounded-lg p-3 text-gray-400">${shortAddress}</div>
                </div>
                
                <div>
                    <label for="name" class="block text-white text-sm font-medium mb-2">Name</label>
                    <input type="text" id="name" name="name" required
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg p-3 text-white">
                </div>
                
                <div>
                    <label for="email" class="block text-white text-sm font-medium mb-2">Email Address</label>
                    <input type="email" id="email" name="email" required
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg p-3 text-white">
                </div>
                
                <div class="pt-4">
                    <button type="submit" 
                        class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 px-4 rounded-lg transition-colors">
                        Complete Registration
                    </button>
                </div>
            </form>
        </div>
    `;

            document.body.appendChild(modal);

            document.getElementById('registration-form').addEventListener('submit', async function(e) {
                e.preventDefault();

                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;

                try {
                    showLoadingMessage('Completing registration...');
                    await verifySignature(walletAddress, signature, walletType, name, email);
                    document.getElementById('registration-modal').remove();
                } catch (error) {
                    console.error('Error during registration:', error);
                    showErrorMessage('Registration failed: ' + error.message);
                } finally {
                    hideLoadingMessage();
                }
            });
        }

        /**
         * Update UI to show connected wallet state
         */
        function updateConnectedUI(address, walletType) {
            const shortAddress = address.substr(0, 6) + '...' + address.substr(-4);

            document.querySelectorAll('.wallet-button').forEach(button => {
                button.classList.remove('connected');
                button.querySelector('span').textContent = button.id.replace('-btn', '').charAt(0).toUpperCase() +
                    button.id.replace('-btn', '').slice(1);
            });

            const connectedButton = document.getElementById(`${walletType}-btn`);
            if (connectedButton) {
                connectedButton.classList.add('connected');
                connectedButton.innerHTML = `
            <div class="flex items-center">
                <img src="${getWalletIconPath(walletType)}" alt="${walletType} Icon" class="w-8 h-8 mr-4">
                <span class="text-lg font-semibold">${shortAddress}</span>
            </div>
            <div class="flex items-center">
                <span class="text-green-400 text-sm mr-2">Connected</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <button class="ml-2 text-red-400 text-sm disconnect-btn" data-wallet-type="${walletType}">Disconnect</button>
            </div>
        `;

                connectedButton.querySelector('.disconnect-btn').addEventListener('click', (e) => {
                    e.stopPropagation();
                    disconnectWallet(walletType);
                });
            }

            const walletInfoHeader = document.getElementById('wallet-info-header');
            if (walletInfoHeader) {
                walletInfoHeader.innerHTML = `
            <div class="flex items-center">
                <img src="${getWalletIconPath(walletType)}" alt="${walletType} Icon" class="w-6 h-6 mr-2">
                <span class="text-sm font-medium">${shortAddress}</span>
            </div>
        `;
            }
        }

        /**
         * Get wallet icon path
         */
        function getWalletIconPath(walletType) {
            return `/assets/wallet/${walletType.charAt(0).toUpperCase() + walletType.slice(1)}.png`;
        }

        /**
         * Disconnect wallet
         */
        async function disconnectWallet(walletType) {
            try {
                showLoadingMessage('Disconnecting wallet...');

                const response = await fetch('/disconnect-wallet', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                });

                const data = await response.json();

                if (data.success) {
                    walletState.connected = false;
                    walletState.address = null;
                    walletState.type = null;
                    walletState.chainId = null;

                    localStorage.removeItem('walletState');
                    resetWalletUI();
                    showSuccessMessage('Wallet disconnected successfully');
                } else {
                    throw new Error(data.error || 'Disconnection failed');
                }
            } catch (error) {
                console.error('Error disconnecting wallet:', error);
                showErrorMessage('Failed to disconnect wallet: ' + error.message);
            } finally {
                hideLoadingMessage();
            }
        }

        /**
         * Reset UI to initial state
         */
        function resetWalletUI() {
            document.querySelectorAll('.wallet-button').forEach(button => {
                button.classList.remove('connected');
                const walletType = button.id.replace('-btn', '');
                button.innerHTML = `
            <div class="flex items-center">
                <img src="${getWalletIconPath(walletType)}" alt="${walletType} Icon" class="w-8 h-8 mr-4">
                <span class="text-lg font-semibold">${walletType.charAt(0).toUpperCase() + walletType.slice(1)}</span>
            </div>
        `;
            });

            const walletInfoHeader = document.getElementById('wallet-info-header');
            if (walletInfoHeader) {
                walletInfoHeader.innerHTML = `
            <div class="flex items-center">
                <span class="text-sm font-medium">Connect Wallet</span>
            </div>
        `;
            }
        }

        /**
         * UI Helper Functions
         */
        function showLoadingState(walletType) {
            const button = document.getElementById(`${walletType}-btn`);
            if (button) {
                button.classList.add('loading');
                button.innerHTML = `
            <div class="flex items-center">
                <img src="${getWalletIconPath(walletType)}" alt="${walletType} Icon" class="w-8 h-8 mr-4">
                <span class="text-lg font-semibold">Connecting...</span>
            </div>
            <div class="spinner"></div>
        `;
            }
        }

        function hideLoadingState(walletType) {
            const button = document.getElementById(`${walletType}-btn`);
            if (button) {
                button.classList.remove('loading');
                if (!walletState.connected || walletState.type !== walletType) {
                    button.innerHTML = `
                <div class="flex items-center">
                    <img src="${getWalletIconPath(walletType)}" alt="${walletType} Icon" class="w-8 h-8 mr-4">
                    <span class="text-lg font-semibold">${walletType.charAt(0).toUpperCase() + walletType.slice(1)}</span>
                </div>
            `;
                }
            }
        }

        function showWalletNotInstalledError(walletName) {
            showErrorMessage(`${walletName} is not installed. Please install it to continue.`);
        }

        function handleWalletError(error, walletType) {
            if (error.code === 4001) {
                showErrorMessage('Connection request was rejected. Please try again.');
            } else {
                console.error(`${walletType} connection error:`, error);
                showErrorMessage(`Failed to connect to ${walletType}: ${error.message || 'Unknown error'}`);
            }
        }

        function showErrorMessage(message) {
            createToast('error', message);
        }

        function showSuccessMessage(message) {
            createToast('success', message);
        }

        function showLoadingMessage(message) {
            let loadingOverlay = document.getElementById('loading-overlay');

            if (!loadingOverlay) {
                loadingOverlay = document.createElement('div');
                loadingOverlay.id = 'loading-overlay';
                loadingOverlay.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                loadingOverlay.innerHTML = `
            <div class="bg-darker rounded-xl p-8 flex items-center">
                <div class="spinner mr-4"></div>
                <span id="loading-message" class="text-white"></span>
            </div>
        `;
                document.body.appendChild(loadingOverlay);
            }

            document.getElementById('loading-message').textContent = message;
        }

        function hideLoadingMessage() {
            const loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) {
                loadingOverlay.remove();
            }
        }

        function createToast(type, message) {
            let toastContainer = document.getElementById('toast-container');

            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'fixed bottom-4 right-4 z-50 flex flex-col space-y-2';
                document.body.appendChild(toastContainer);
            }

            const toast = document.createElement('div');
            toast.className =
                `flex items-center p-4 mb-4 rounded-lg shadow ${type === 'error' ? 'bg-red-900 text-white' : 'bg-green-900 text-white'}`;

            const icon = type === 'error' ?
                '<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>' :
                '<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>';

            toast.innerHTML = `
        ${icon}
        <div class="text-sm font-normal">${message}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 hover:bg-gray-700 inline-flex h-8 w-8 items-center justify-center">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    `;

            toastContainer.appendChild(toast);

            toast.querySelector('button').addEventListener('click', () => {
                toast.remove();
            });

            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 5000);
        }

        // Listen for Ethereum account changes
        let hasRefreshed = false;

        if (window.ethereum) {
            ethereum.on('accountsChanged', (accounts) => {
                if (accounts.length === 0) {
                    walletState.connected = false;
                    walletState.address = null;
                    localStorage.removeItem('walletState');
                    resetWalletUI();
                } else {
                    const newAddress = accounts[0];
                    if (walletState.connected && walletState.address !== newAddress) {
                        connectWallet('metamask');
                    }
                }
            });

            ethereum.on('chainChanged', (chainId) => {
                if (!hasRefreshed) {
                    hasRefreshed = true;
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                }
            });
        }
    </script>
@endpush
