@extends('layouts.layout')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    /* Web3 Form Styling */
    .web3-input {
        background-color: #2d2d4a;
        border: 2px solid transparent;
        border-image: linear-gradient(90deg, #a78bfa 0%, #00ddeb 100%) 1;
        color: #ffffff;
        transition: all 0.3s ease;
    }
    .web3-input:focus {
        box-shadow: 0 0 15px rgba(167, 139, 250, 0.5);
        outline: none;
    }
    .web3-input::placeholder {
        color: #a78bfa;
    }
    /* Reuse web3-create-button from navbar */
    .web3-create-button {
        background: linear-gradient(90deg, #a78bfa 0%, #00ddeb 100%);
        box-shadow: 0 0 10px rgba(167, 139, 250, 0.5);
        transform: perspective(500px) translateZ(0);
        transition: all 0.3s ease;
    }
    .web3-create-button:hover {
        background: linear-gradient(90deg, #7c3aed 0%, #00b7c2 100%);
        box-shadow: 0 0 20px rgba(167, 139, 250, 0.8), 0 0 30px rgba(0, 221, 235, 0.5);
        transform: perspective(500px) translateZ(5px);
    }
    .web3-create-button:active {
        transform: perspective(500px) translateZ(-2px);
    }
    @keyframes pulse {
        0% { box-shadow: 0 0 10px rgba(167, 139, 250, 0.5); }
        50% { box-shadow: 0 0 15px rgba(167, 139, 250, 0.7); }
        100% { box-shadow: 0 0 10px rgba(167, 139, 250, 0.5); }
    }
    .web3-create-button {
        animation: pulse 2s infinite;
    }
    /* Error message */
    .error-message {
        color: #ff5555;
        font-size: 0.875rem;
    }
    /* Image preview */
    .image-preview {
        max-height: 200px;
        margin-top: 10px;
        border-radius: 8px;
        width: 100%;
        object-fit: contain;
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
    }
    .preview-remove:hover {
        background: rgba(255, 0, 0, 1);
    }
    /* Loading indicator */
    .loading-overlay {
        display: none;
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 8px;
        justify-content: center;
        align-items: center;
        z-index: 10;
    }
    .spinner {
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top: 4px solid #a78bfa;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    /* Status alert */
    .status-alert {
        display: none;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    .status-alert.success {
        background-color: rgba(0, 200, 83, 0.2);
        border: 1px solid #00c853;
        color: #00c853;
    }
    .status-alert.error {
        background-color: rgba(255, 85, 85, 0.2);
        border: 1px solid #ff5555;
        color: #ff5555;
    }
</style>
@endpush

@push('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="bg-darker min-h-screen py-8 px-4 sm:px-6 lg:px-8">
    <div class="container mx-auto max-w-2xl">
        <h1 class="text-3xl text-white font-bold mb-6 text-center">Create Your NFT</h1>
        
        <!-- Status Alert -->
        <div id="status-alert" class="status-alert">
            <span id="status-message"></span>
        </div>
        
        <form id="nft-form" class="bg-gray-800 rounded-lg p-6 shadow-lg space-y-6 relative">
            <!-- Loading Overlay -->
            <div id="loading-overlay" class="loading-overlay">
                <div class="spinner"></div>
            </div>
            
            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-light-purple font-medium mb-2">NFT Image</label>
                <input type="file" id="image" accept="image/*" class="web3-input w-full p-2 rounded-lg" required>
                <div id="preview-container" class="preview-container">
                    <img id="image-preview" class="image-preview" alt="NFT image preview">
                    <button id="preview-remove" class="preview-remove" aria-label="Remove image preview">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <p id="image-error" class="error-message hidden mt-1"></p>
            </div>
            
            <!-- Name -->
            <div>
                <label for="name" class="block text-light-purple font-medium mb-2">Name</label>
                <input type="text" id="name" placeholder="Enter NFT name" class="web3-input w-full p-2 rounded-lg" required>
                <p id="name-error" class="error-message hidden mt-1"></p>
            </div>
            
            <!-- Description -->
            <div>
                <label for="description" class="block text-light-purple font-medium mb-2">Description</label>
                <textarea id="description" placeholder="Describe your NFT" class="web3-input w-full p-2 rounded-lg h-32 resize-none" required></textarea>
                <p id="description-error" class="error-message hidden mt-1"></p>
            </div>
            
            <!-- Price -->
            <div>
                <label for="price" class="block text-light-purple font-medium mb-2">Price (ETH)</label>
                <input type="number" id="price" placeholder="e.g., 0.1" step="0.0001" min="0.0001" class="web3-input w-full p-2 rounded-lg" required>
                <p id="price-error" class="error-message hidden mt-1"></p>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="web3-create-button w-full text-white font-semibold px-4 py-3 rounded-lg flex items-center justify-center">
                <i class="fas fa-paint-brush mr-2"></i>Mint NFT
            </button>
        </form>
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
                
                // Verify contract deployment
                try {
                    const listPrice = await contract.getListPrice();
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
            
            const listPrice = await contract.getListPrice();
            const ethPrice = ethers.utils.parseEther(price.toString());
            
            // Estimate gas for createToken
            let gasLimit;
            try {
                gasLimit = await contract.estimateGas.createToken(tokenURI, ethPrice, {
                    value: listPrice
                });
                gasLimit = gasLimit.mul(150).div(100); // Add 50% buffer
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
            }
            showError('price', errorMessage);
            showStatus('Failed to create NFT. See error details below.', 'error');
        }
    });
});
</script>
@endsection