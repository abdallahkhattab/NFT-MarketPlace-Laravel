<section class="py-10 px-6 md:px-10">
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-bold">Discover More NFTs</h2>
                <p class="text-gray-400 mt-2">Explore New Trending NFTs</p>
            </div>
            <a href="#" class="hidden md:flex items-center border border-light-purple text-light-purple px-6 py-3 rounded-within-full hover:bg-light-purple hover:text-white transition-all">
                <i class="far fa-eye mr-2"></i> See All
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="nft-grid">
            <!-- Dynamic NFTs will be populated here -->
        </div>

        <div class="flex justify-center mt-10 md:hidden">
            <a href="#" class="flex items-center border border-light-purple text-light-purple px-6 py-3 rounded-full hover:bg-light-purple hover:text-white transition-all">
                <i class="far fa-eye mr-2"></i> See All
            </a>
        </div>

        <!-- Loader Overlay -->
        <div class="loader-overlay" id="loader-overlay" style="display: none;">
            <div class="text-center">
                <div class="loader"></div>
                <p class="loader-text">Loading NFTs...</p>
            </div>
        </div>
    </div>

    <!-- Styles -->
    <style>
        /* Loader Styles */
        .loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(18, 18, 18, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            transition: opacity 0.3s ease;
        }
        .loader {
            border: 4px solid rgba(162, 89, 255, 0.2);
            border-top: 4px solid #a259ff;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            animation: spin 1s linear infinite;
        }
        .loader-text {
            color: #bd83ff;
            font-size: 0.9rem;
            margin-top: 12px;
            animation: pulse-light 1.5s ease-in-out infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes pulse-light {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }

        /* Status Alert */
        .status-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 20px;
            border-radius: 8px;
            z-index: 1000;
            font-size: 0.9rem;
            transition: opacity 0.3s ease;
        }

        /* NFT Card Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Static NFT data
            const staticNFTs = [
                {
                    tokenId: 1,
                    name: 'this is my first nft #1',
                    description: 'SPACE NFT SUPER UNIQUE',
                    image: 'https://beige-main-louse-684.mypinata.cloud/ipfs/QmNWkwcj8G8PKNjE4bqDh6qC9Z5yeHPPej5zV8hvjKna6C',
                    price: '0.1',
                    seller: '0x1f3A2a3D9525b54DbF180365971f28B44fD8a1B2',
                    category: 'Art'
                },
               
               
            ];

            // gravedigger

            // DOM elements
            const nftGrid = document.getElementById('nft-grid');

            // Show status alert
            function showStatus(message, type) {
                const statusAlert = document.createElement('div');
                statusAlert.className = `status-alert ${type}`;
                statusAlert.style.background = type === 'success' ? 'rgba(0, 200, 83, 0.2)' : type === 'warning' ? 'rgba(255, 193, 7, 0.2)' : 'rgba(255, 85, 85, 0.2)';
                statusAlert.style.border = type === 'success' ? '1px solid #00c853' : type === 'warning' ? '1px solid #ffc107' : '1px solid #ff5555';
                statusAlert.style.color = type === 'success' ? '#00c853' : type === 'warning' ? '#ffc107' : '#ff5555';
                statusAlert.textContent = message;
                document.body.appendChild(statusAlert);
                setTimeout(() => statusAlert.remove(), 5000);
            }

            // Render NFTs
            function renderNFTs(nfts) {
                nftGrid.innerHTML = '';
                nfts.forEach((nft, index) => {
                    const card = document.createElement('div');
                    card.className = 'nft-card rounded-2xl overflow-hidden bg-gray-800';
                    card.style.animation = `fadeIn 0.5s ease-out forwards`;
                    card.style.animationDelay = `${0.1 * (index + 1)}s`;
                    card.innerHTML = `
                        <div class="h-64 overflow-hidden">
                            <img src="${nft.image}" alt="${nft.name}" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/400x400?text=Image+Error';">
                        </div>
                        <div class="p-5">
                            <h3 class="text-xl font-bold mb-3">${nft.name}</h3>
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                                    <img src="https://via.placeholder.com/50/50?text=${nft.seller.slice(2, 4)}" alt="${nft.seller}" class="w-full h-full object-cover">
                                </div>
                                <span class="ml-2 text-gray-300">${nft.seller.slice(0, 6)}...${nft.seller.slice(-4)}</span>
                            </div>
                            <div class="flex justify-between mt-2 pt-3 border-t border-gray-700">
                                <div>
                                    <p class="text-xs text-gray-400">Price</p>
                                    <p class="font-medium">${nft.price} ETH</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 text-right">Highest Bid</p>
                                    <p class="font-medium text-right">N/A</p>
                                </div>
                            </div>
                        </div>
                    `;
                    nftGrid.appendChild(card);
                });
            }

           

        });
    </script>
</section>