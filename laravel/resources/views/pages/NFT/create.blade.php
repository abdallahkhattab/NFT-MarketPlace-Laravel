
@extends('layouts.layout')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
<style>
    /* Futuristic Form Container */
    .holographic-form {
        background: linear-gradient(135deg, rgba(45, 45, 74, 0.8), rgba(20, 20, 50, 0.8));
        border: 2px solid transparent;
        border-image: linear-gradient(90deg, #a78bfa 0%, #00ddeb 100%) 1;
        box-shadow: 0 0 20px rgba(167, 139, 250, 0.3), 0 0 40px rgba(0, 221, 235, 0.2);
        transform: perspective(1000px) translateZ(0);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .holographic-form:hover {
        transform: perspective(1000px) translateZ(10px);
        box-shadow: 0 0 30px rgba(167, 139, 250, 0.5), 0 0 60px rgba(0, 221, 235, 0.3);
    }
    .holographic-form::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 1s ease;
        z-index: 0;
    }
    .holographic-form:hover::before {
        left: 100%;
    }

    /* Digital Grid Background */
    .grid-bg {
        position: absolute;
        inset: 0;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"><path d="M0 10h20M10 0v20" stroke="rgba(167, 139, 250, 0.1)" stroke-width="1"/></svg>') repeat;
        opacity: 0.3;
        z-index: -1;
    }

    /* Futuristic Input Fields */
    .web3-input {
        background: rgba(45, 45, 74, 0.5);
        border: 2px solid transparent;
        border-image: linear-gradient(90deg, #a78bfa 0%, #00ddeb 100%) 1;
        color: #ffffff;
        font-family: 'Orbitron', sans-serif;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }
    .web3-input:focus {
        box-shadow: 0 0 15px rgba(167, 139, 250, 0.7), 0 0 25px rgba(0, 221, 235, 0.4);
        outline: none;
        transform: scale(1.02);
    }
    .web3-input::placeholder {
        color: #a78bfa;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }
    .web3-input:focus::placeholder {
        opacity: 0;
    }

    /* Animated Labels */
    .web3-label {
        position: relative;
        display: block;
        color: #a78bfa;
        font-family: 'Orbitron', sans-serif;
        transition: all 0.3s ease;
    }
    .web3-label::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: linear-gradient(90deg, #a78bfa, #00ddeb);
        transition: width 0.3s ease;
    }
    .web3-input:focus + .web3-label::after,
    .web3-input:not(:placeholder-shown) + .web3-label::after {
        width: 100%;
    }

    /* Mint Button */
    .web3-create-button {
        background: linear-gradient(45deg, #a78bfa, #00ddeb);
        border: 1px solid transparent;
        border-image: linear-gradient(90deg, #a78bfa, #00ddeb) 1;
        box-shadow: 0 0 15px rgba(167, 139, 250, 0.5), 0 0 25px rgba(0, 221, 235, 0.3);
        font-family: 'Orbitron', sans-serif;
        transform: perspective(500px) translateZ(0);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    .web3-create-button:hover {
        background: linear-gradient(45deg, #7c3aed, #00b7c2);
        box-shadow: 0 0 25px rgba(167, 139, 250, 0.8), 0 0 40px rgba(0, 221, 235, 0.5);
        transform: perspective(500px) translateZ(10px);
    }
    .web3-create-button:active {
        transform: perspective(500px) translateZ(-2px);
    }
    .web3-create-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
        z-index: -1;
    }
    .web3-create-button:hover::before {
        left: 100%;
    }
    .web3-create-button::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"><circle cx="5" cy="5" r="2" fill="rgba(255,255,255,0.5)"/></svg>') repeat;
        opacity: 0;
        animation: sparkle 2s infinite;
        z-index: -1;
    }
    @keyframes sparkle {
        0% { opacity: 0; transform: translate(0, 0); }
        50% { opacity: 0.3; transform: translate(2px, 2px); }
        100% { opacity: 0; transform: translate(0, 0); }
    }
    @keyframes pulse {
        0% { box-shadow: 0 0 15px rgba(167, 139, 250, 0.5), 0 0 25px rgba(0, 221, 235, 0.3); }
        50% { box-shadow: 0 0 20px rgba(167, 139, 250, 0.7), 0 0 35px rgba(0, 221, 235, 0.4); }
        100% { box-shadow: 0 0 15px rgba(167, 139, 250, 0.5), 0 0 25px rgba(0, 221, 235, 0.3); }
    }
    .web3-create-button {
        animation: pulse 2s infinite;
    }

    /* Image Preview */
    .image-preview {
        max-height: 200px;
        width: 100%;
        object-fit: contain;
        border-radius: 8px;
        border: 1px solid #a78bfa;
        box-shadow: 0 0 10px rgba(167, 139, 250, 0.3);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .image-preview:hover {
        box-shadow: 0 0 15px rgba(167, 139, 250, 0.5);
        transform: scale(1.02);
        filter: url(#glitch);
    }
    .preview-container {
        position: relative;
        display: none;
        margin-top: 10px;
    }
    .preview-remove {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(255, 0, 0, 0.7);
        color: white;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s ease;
        z-index: 2;
    }
    .preview-remove:hover {
        background: rgba(255, 0, 0, 1);
    }

    /* Image Preview Modal */
    #image-preview-modal {
        transition: opacity 0.3s ease;
    }
    #image-preview-modal.show {
        opacity: 1;
    }
    .modal-content {
        background: rgba(45, 45, 74, 0.9);
        border: 2px solid transparent;
        border-image: linear-gradient(90deg, #a78bfa 0%, #00ddeb 100%) 1;
        box-shadow: 0 0 20px rgba(167, 139, 250, 0.5), 0 0 40px rgba(0, 221, 235, 0.3);
        animation: fadeIn 0.3s ease forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .modal-image {
        max-height: 500px;
        object-fit: contain;
        border-radius: 8px;
        filter: url(#glitch);
    }
    .modal-close {
        background: rgba(255, 0, 0, 0.7);
        color: white;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        transition: background 0.2s ease, transform 0.2s ease;
    }
    .modal-close:hover {
        background: rgba(255, 0, 0, 1);
        transform: scale(1.1);
    }
    @media (max-width: 768px) {
        .modal-content {
            max-width: 90%;
            padding: 1rem;
        }
        .modal-image {
            max-height: 300px;
        }
    }

    /* Loading Overlay */
    .loading-overlay {
        display: none;
        position: absolute;
        inset: 0;
        background: rgba(20, 20, 50, 0.9);
        border-radius: 8px;
        justify-content: center;
        align-items: center;
        z-index: 10;
    }
    .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid rgba(167, 139, 250, 0.3);
        border-top: 4px solid #a78bfa;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        position: relative;
    }
    .spinner::before {
        content: '';
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        border: 2px solid transparent;
        border-top: 2px solid #00ddeb;
        border-radius: 50%;
        animation: orbit 2s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    @keyframes orbit {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(-360deg); }
    }

    /* Status Alert */
    .status-alert {
        display: none;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-family: 'Orbitron', sans-serif;
        border: 1px solid transparent;
        animation: fadeIn 0.5s ease;
    }
    .status-alert.success {
        background: linear-gradient(90deg, rgba(0, 200, 83, 0.2), rgba(0, 200, 83, 0.1));
        border-image: linear-gradient(90deg, #00c853, #00a843) 1;
        color: #00c853;
    }
    .status-alert.error {
        background: linear-gradient(90deg, rgba(255, 85, 85, 0.2), rgba(255, 85, 85, 0.1));
        border-image: linear-gradient(90deg, #ff5555, #cc4444) 1;
        color: #ff5555;
    }

    /* Error Message */
    .error-message {
        color: #ff5555;
        font-size: 0.875rem;
        font-family: 'Orbitron', sans-serif;
        margin-top: 4px;
    }

    /* Chain Animation */
    .chain-animation {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(to right, transparent, #a78bfa, #00ddeb, transparent);
        animation: chain-flow 4s linear infinite;
        z-index: -1;
    }
    @keyframes chain-flow {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    /* SVG Filter for Glitch Effect */
    svg#glitch-filter {
        position: absolute;
        width: 0;
        height: 0;
    }
</style>
@endpush

@push('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<!-- SVG Filter for Glitch Effect -->
<svg id="glitch-filter">
    <filter id="glitch">
        <feTurbulence type="fractalNoise" baseFrequency="0.01" numOctaves="1" result="noise"/>
        <feDisplacementMap in="SourceGraphic" in2="noise" scale="2" xChannelSelector="R" yChannelSelector="G"/>
    </filter>
</svg>

<div class="bg-darker min-h-screen py-8 px-4 sm:px-6 lg:px-8 relative">
    <div class="container mx-auto max-w-2xl">
        <h1 class="text-4xl text-white font-bold mb-8 text-center" style="font-family: 'Orbitron', sans-serif; text-shadow: 0 0 10px #a78bfa, 0 0 20px #00ddeb;">
            Create Your NFT
        </h1>
        
        <!-- Status Alert -->
        <div id="status-alert" class="status-alert">
            <span id="status-message"></span>
        </div>
        
        <form id="nft-form" class="holographic-form rounded-lg p-8 space-y-6 relative">
            <!-- Digital Grid Background -->
            <div class="grid-bg"></div>
            <!-- Chain Animation -->
            <div class="chain-animation"></div>
            <!-- Loading Overlay -->
            <div id="loading-overlay" class="loading-overlay">
                <div class="spinner"></div>
            </div>
            
            <!-- Image Upload -->
            <div>
                <label for="image" class="web3-label mb-2">NFT Image</label>
                <input type="file" id="image" accept="image/*" class="web3-input w-full p-3 rounded-lg" placeholder="Select image" required>
                <div id="preview-container" class="preview-container">
                    <img id="image-preview" class="image-preview" alt="NFT image preview">
                    <button id="preview-remove" class="preview-remove" aria-label="Remove image preview">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <p id="image-error" class="error-message hidden"></p>
            </div>
            
            <!-- Name -->
            <div>
                <label for="name" class="web3-label mb-2">Name</label>
                <input type="text" id="name" placeholder="Enter NFT name" class="web3-input w-full p-3 rounded-lg" required>
                <p id="name-error" class="error-message hidden"></p>
            </div>
            
            <!-- Description -->
            <div>
                <label for="description" class="web3-label mb-2">Description</label>
                <textarea id="description" placeholder="Describe your NFT" class="web3-input w-full p-3 rounded-lg h-32 resize-none" required></textarea>
                <p id="description-error" class="error-message hidden"></p>
            </div>
            
            <!-- Price -->
            <div>
                <label for="price" class="web3-label mb-2">Price (ETH)</label>
                <input type="number" id="price" placeholder="e.g., 0.1" step="0.0001" min="0.0001" class="web3-input w-full p-3 rounded-lg" required>
                <p id="price-error" class="error-message hidden"></p>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="web3-create-button w-full text-white font-semibold px-4 py-3 rounded-lg flex items-center justify-center">
                <i class="fas fa-coins mr-2 text-yellow-300"></i> Mint NFT
            </button>
        </form>

        <!-- Image Preview Modal -->
        <div id="image-preview-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 backdrop-blur-sm hidden z-50 flex items-center justify-center">
            <div class="modal-content relative rounded-lg max-w-3xl w-full mx-4 p-4">
                <!-- Close Button -->
                <button id="modal-close" class="modal-close absolute top-4 right-4" aria-label="Close preview">
                    <i class="fas fa-times"></i>
                </button>
                <!-- Preview Image -->
                <div class="relative w-full h-[500px]">
                    <img id="modal-image" class="modal-image w-full h-full" alt="NFT image preview">
                    <div class="absolute inset-0 bg-gradient-to-br from-[rgba(167,139,250,0.2)] to-[rgba(0,221,235,0.2)] rounded-lg"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Axios with CSRF token
    axios.get('/sanctum/csrf-cookie').then(() => {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
    }).catch(error => {
        console.error('Failed to fetch CSRF token:', error);
        showStatus('Failed to initialize authentication. Please refresh the page.', 'error');
    });

    // Web3 configuration from backend
    const web3Config = @json($web3Config);
    let provider, signer, contract;
    let imageHash = null;
    let listPrice = null; // Store listPrice here
    
    // DOM elements
    const nftForm = document.getElementById('nft-form');
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    const previewContainer = document.getElementById('preview-container');
    const previewRemove = document.getElementById('preview-remove');
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const priceInput = document.getElementById('price');
    const loadingOverlay = document.getElementById('loading-overlay');
    const statusAlert = document.getElementById('status-alert');
    const statusMessage = document.getElementById('status-message');
    const previewModal = document.getElementById('image-preview-modal');
    const modalImage = document.getElementById('modal-image');
    const modalClose = document.getElementById('modal-close');
    
    // Initialize ethers provider and contract
    async function initWeb3() {
        try {
            if (!window.ethers) {
                throw new Error("Ethers.js not loaded. Please check Vite configuration.");
            }
            if (!ethers.providers) {
                throw new Error("Ethers.js providers not available. Ensure resources/js/ethers.min.js is the correct UMD bundle for v5.7.2.");
            }
            if (window.ethereum) {
                provider = new ethers.providers.Web3Provider(window.ethereum);
                await provider.send("eth_requestAccounts", []);
                signer = provider.getSigner();
                const address = await signer.getAddress();
                console.log(`Connected with account: ${address}`);
                
                contract = new ethers.Contract(
                    web3Config.contractAddress,
                    web3Config.contractABI,
                    signer
                );
                
                // Verify contract deployment and store listPrice
                try {
                    listPrice = await contract.getListPrice();
                    console.log(`List price: ${ethers.utils.formatEther(listPrice)} ETH`);
                } catch (error) {
                    throw new Error(`Contract verification failed: ${error.message}`);
                }
                
                return true;
            } else {
                showError('price', 'MetaMask is not installed. Please install MetaMask to create NFTs.');
                return false;
            }
        } catch (error) {
            console.error('Failed to initialize Web3', error);
            showError('price', `Failed to connect wallet: ${error.message}`);
            return false;
        }
    }
    
    // Show error message
    function showError(field, message) {
        const errorElement = document.getElementById(`${field}-error`);
        errorElement.textContent = message;
        errorElement.classList.remove('hidden');
    }
    
    // Clear all error messages
    function clearErrors() {
        ['image', 'name', 'description', 'price'].forEach(field => {
            const errorElement = document.getElementById(`${field}-error`);
            errorElement.textContent = '';
            errorElement.classList.add('hidden');
        });
    }
    
    // Show status alert
    function showStatus(message, type) {
        statusAlert.className = `status-alert ${type}`;
        statusMessage.textContent = message;
        statusAlert.style.display = 'block';
        
        setTimeout(() => {
            statusAlert.style.display = 'none';
        }, 5000);
    }
    
    // Show loading state
    function showLoading(show) {
        loadingOverlay.style.display = show ? 'flex' : 'none';
    }
    
    // Handle image preview
    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                showError('image', 'Please select a valid image file');
                imageInput.value = '';
                return;
            }

            // Validate file size (max 5MB)
            const maxSize = 5 * 1024 * 1024; // 5MB in bytes
            if (file.size > maxSize) {
                showError('image', 'Image size must be less than 5MB');
                imageInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.style.display = 'inline-block';
            };
            reader.onerror = function() {
                showError('image', 'Error reading image file');
                imageInput.value = '';
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
            imagePreview.src = '';
            imageHash = null;
        }
    });
    
    // Remove image preview
    previewRemove.addEventListener('click', function() {
        imageInput.value = '';
        previewContainer.style.display = 'none';
        imagePreview.src = '';
        imageHash = null;
        clearErrors();
    });
    
    // Open image preview modal
    imagePreview.addEventListener('click', function() {
        if (imagePreview.src) {
            modalImage.src = imagePreview.src;
            previewModal.classList.remove('hidden');
            previewModal.classList.add('show');
            previewModal.querySelector('.modal-content').classList.add('fadeIn');
        }
    });
    
    // Close modal
    modalClose.addEventListener('click', function() {
        previewModal.classList.remove('show');
        previewModal.querySelector('.modal-content').classList.remove('fadeIn');
        setTimeout(() => previewModal.classList.add('hidden'), 300);
    });
    
    // Close modal on outside click
    previewModal.addEventListener('click', function(e) {
        if (e.target === previewModal) {
            previewModal.classList.remove('show');
            previewModal.querySelector('.modal-content').classList.remove('fadeIn');
            setTimeout(() => previewModal.classList.add('hidden'), 300);
        }
    });
    
    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !previewModal.classList.contains('hidden')) {
            previewModal.classList.remove('show');
            previewModal.querySelector('.modal-content').classList.remove('fadeIn');
            setTimeout(() => previewModal.classList.add('hidden'), 300);
        }
    });
    
    // Form submission
    nftForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        clearErrors();
        
        const image = imageInput.files[0];
        const name = nameInput.value.trim();
        const description = descriptionInput.value.trim();
        const price = parseFloat(priceInput.value);
        
        if (!image && !imageHash) {
            showError('image', 'Please select an image');
            return;
        }
        
        if (name.length < 3) {
            showError('name', 'Name must be at least 3 characters');
            return;
        }
        
        if (description.length < 10) {
            showError('description', 'Description must be at least 10 characters');
            return;
        }
        
        if (isNaN(price) || price <= 0) {
            showError('price', 'Price must be a positive number');
            return;
        }
        
        showLoading(true);
        const initialized = await initWeb3();
        if (!initialized) {
            showLoading(false);
            return;
        }
        
        try {
            // Check wallet balance
            const walletAddress = await signer.getAddress();
            const balance = await provider.getBalance(walletAddress);
            const totalCost = listPrice.add(ethers.utils.parseEther(price.toString()));
            if (balance.lt(totalCost)) {
                showLoading(false);
                showError('price', `Insufficient funds. Need at least ${ethers.utils.formatEther(totalCost)} ETH. Please fund your wallet using a Sepolia faucet (e.g., https://sepolia-faucet.alchemy.com).`);
                return;
            }

            if (!imageHash) {
                const formData = new FormData();
                formData.append('image', image);
                const imageResponse = await axios.post("{{ route('nft.upload-image') }}", formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                }).catch(error => {
                    if (error.response) {
                        if (error.response.status === 401) {
                            throw new Error("Unauthorized: Please log in again.");
                        }
                        if (error.response.status === 404) {
                            throw new Error("Image upload endpoint not found. Check routes/api.php.");
                        }
                        throw new Error(error.response.data.message || "Failed to upload image");
                    }
                    throw error;
                });
                
                if (!imageResponse.data.success) {
                    showError('image', imageResponse.data.message || 'Failed to upload image');
                    showLoading(false);
                    return;
                }
                
                imageHash = imageResponse.data.ipfsHash;
                showStatus('Image uploaded to IPFS', 'success');
            }
            
            const metadataResponse = await axios.post("{{ route('nft.create-metadata') }}", {
                name,
                description,
                imageHash
            }).catch(error => {
                if (error.response) {
                    if (error.response.status === 401) {
                        throw new Error("Unauthorized: Please log in again.");
                    }
                    if (error.response.status === 404) {
                        throw new Error("Metadata endpoint not found. Check routes/api.php.");
                    }
                    throw new Error(error.response.data.message || "Failed to create metadata");
                }
                throw error;
            });
            
            if (!metadataResponse.data.success) {
                showError('description', metadataResponse.data.message || 'Failed to create metadata');
                showLoading(false);
                return;
            }
            
            const tokenURI = metadataResponse.data.tokenURI;
            showStatus('Metadata uploaded to IPFS', 'success');
            
            const ethPrice = ethers.utils.parseEther(price.toString());
            
            // Estimate gas for createToken
            let gasLimit;
            try {
                gasLimit = await contract.estimateGas.createToken(tokenURI, ethPrice, {
                    value: listPrice
                });
                gasLimit = gasLimit.mul(115).div(100); // 15% buffer
            } catch (error) {
                throw new Error(`Gas estimation failed: ${error.message}. Check contract logic or listPrice.`);
            }
            
            const mintTx = await contract.createToken(tokenURI, ethPrice, {
                value: listPrice,
                gasLimit: gasLimit
            });
            
            showStatus(`Transaction submitted: ${mintTx.hash}. Waiting for confirmation...`, 'success');
            
            const receipt = await mintTx.wait();
            if (receipt.status === 0) {
                throw new Error(`Transaction failed: Check contract logic or listPrice. Transaction hash: ${mintTx.hash}`);
            }
            
            const event = receipt.events.find(e => e.event === 'TokenListedSuccess');
            if (!event) {
                throw new Error('TokenListedSuccess event not found in transaction receipt');
            }
            const tokenId = event.args.tokenId.toString();
            
            showLoading(false);
            showStatus(`NFT created successfully! Token ID: ${tokenId}`, 'success');
            
            setTimeout(() => {
                window.location.href = "{{ route('marketplace') }}";
            }, 3000);
            
        } catch (error) {
            console.error('Error creating NFT:', error);
            showLoading(false);
            let errorMessage = error.message || 'Error creating NFT';
            if (error.code === 'CALL_EXCEPTION') {
                errorMessage = `Smart contract error: Transaction reverted. Check listPrice, contract logic, or token URI. Transaction hash: ${error.transactionHash || 'unknown'}`;
                if (error.reason) {
                    errorMessage += ` Revert reason: ${error.reason}`;
                }
            } else if (error.response && error.response.status === 401) {
                errorMessage = 'Authentication failed: Please log in again.';
            } else if (error.code === 4001) {
                errorMessage = 'Transaction rejected by user.';
            } else if (error.message.includes('insufficient funds')) {
                errorMessage = `Insufficient funds. Please fund your wallet using a Sepolia faucet (e.g., https://sepolia-faucet.alchemy.com).`;
            }
            showError('price', errorMessage);
            showStatus('Failed to create NFT. See error details below.', 'error');
        }
    });
});
</script>
@endsection
