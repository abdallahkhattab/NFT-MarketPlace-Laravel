
<style>
     /* NFT Card Styles - Enhanced */
     .nft-card {
        background: rgba(31, 29, 43, 0.6);
        backdrop-filter: blur(5px);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(162, 89, 255, 0.1);
        position: relative;
        overflow: hidden;
        height: 100%;
        transform: translateZ(0);
        backface-visibility: hidden;
        perspective: 1000px;
    }
    .nft-card:hover {
        transform: translateY(-8px) scale(1.02);
        animation: card-glow 2s infinite;
        border-color: rgba(162, 89, 255, 0.5);
        z-index: 1;
    }
    .nft-img-container {
        overflow: hidden;
        position: relative;
    }
    .nft-img-container:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(0deg, rgba(26, 26, 26, 0.4) 0%, rgba(26, 26, 26, 0) 40%);
        z-index: 1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .nft-card:hover .nft-img-container:before {
        opacity: 1;
    }
    .nft-img-container img {
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .nft-card:hover .nft-img-container img {
        transform: scale(1.12);
    }
    .nft-content {
        padding: 12px;
        position: relative;
        z-index: 2;
    }
    .nft-title {
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 6px;
        transition: all 0.3s ease;
        position: relative;
        display: inline-block;
    }
    .nft-card:hover .nft-title {
        color: #d4b0ff;
    }
    .nft-creator {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .creator-badge {
        background: linear-gradient(45deg, #a259ff, #7b45e7);
        border: 2px solid #1a1a1a;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    .nft-card:hover .creator-badge {
        transform: scale(1.1);
        box-shadow: 0 0 8px rgba(162, 89, 255, 0.5);
    }
    .creator-name {
        color: #a0a0a0;
        font-size: 0.75rem;
        transition: all 0.3s ease;
        margin-left: 8px;
    }
    .nft-card:hover .creator-name {
        color: #d4b0ff;
    }
    .nft-details {
        display: flex;
        justify-content: space-between;
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid rgba(162, 89, 255, 0.1);
    }
    .price-label, .bid-label {
        color: #808080;
        font-size: 0.7rem;
        margin-bottom: 2px;
    }
    .price-value {
        color: white;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .bid-value {
        color: #bd83ff;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .nft-card:hover .price-value {
        color: white;
    }
    .nft-card:hover .bid-value {
        color: #d4b0ff;
    }
    
    /* Category Tag */
    .category-tag {
        background: rgba(162, 89, 255, 0.15);
        border: 1px solid rgba(162, 89, 255, 0.3);
        transition: all 0.3s ease;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.65rem;
        color: #d4b0ff;
        position: absolute;
        top: 8px;
        left: 8px;
        z-index: 2;
        backdrop-filter: blur(4px);
    }
    .nft-card:hover .category-tag {
        background: rgba(162, 89, 255, 0.3);
        box-shadow: 0 0 8px rgba(162, 89, 255, 0.3);
    }
    
    /* Buy Now Button - Shows on Hover */
    .buy-button {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(90deg, #a259ff, #7b45e7);
        color: white;
        text-align: center;
        padding: 8px 0;
        font-weight: 500;
        transform: translateY(100%);
        transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        opacity: 0;
        z-index: 3;
    }
    .nft-card:hover .buy-button {
        transform: translateY(0);
        opacity: 1;
    }
    
    /* Favorite Button */
    .favorite-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        z-index: 2;
        background: rgba(31, 29, 43, 0.7);
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(162, 89, 255, 0.3);
        backdrop-filter: blur(4px);
        transform: scale(0.8);
        opacity: 0;
        transition: all 0.3s ease;
    }
    .nft-card:hover .favorite-btn {
        opacity: 1;
        transform: scale(1);
    }
    .favorite-btn:hover {
        background: rgba(162, 89, 255, 0.3);
        transform: scale(1.1) !important;
    }
    .favorite-icon {
        color: white;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    .favorite-btn:hover .favorite-icon {
        color: #ff6b81;
    }
 </style>
 
 <!-- NFT Grid - Enhanced Cards, 4 per row on larger screens -->
 <div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 grid-loading">
        <!-- NFT Card 1 -->
        <div class="nft-card rounded-xl" style="animation: fadeIn 0.5s ease-out forwards; animation-delay: 0.1s;">
            <div class="nft-img-container h-40">
                <img src="{{ asset('assets/nft_images/magic2.png') }}" alt="Magic Mushroom 0325" class="w-full h-full object-cover">
                <span class="category-tag">Art</span>
                <button class="favorite-btn">
                    <svg class="favorite-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </button>
            </div>
            <div class="nft-content">
                <h3 class="nft-title">Magic Mushroom 0325</h3>
                <div class="nft-creator">
                    <div class="w-6 h-6 rounded-full overflow-hidden creator-badge">
                        <img src="/api/placeholder/30/30" alt="MoonDancer" class="w-full h-full object-cover">
                    </div>
                    <span class="creator-name">MoonDancer</span>
                </div>
                <div class="nft-details">
                    <div>
                        <p class="price-label">Price</p>
                        <p class="price-value">1.63 ETH</p>
                    </div>
                    <div class="text-right">
                        <p class="bid-label">Highest Bid</p>
                        <p class="bid-value">0.33 wETH</p>
                    </div>
                </div>
            </div>
            <div class="buy-button">Buy Now</div>
        </div>

        <!-- NFT Card 2 -->
        <div class="nft-card rounded-xl" style="animation: fadeIn 0.5s ease-out forwards; animation-delay: 0.15s;">
            <div class="nft-img-container h-40">
                <img src="{{ asset('assets/nft_images/happy_robot_032.png') }}" alt="Happy Robot 032" class="w-full h-full object-cover">
                <span class="category-tag">Collectibles</span>
                <button class="favorite-btn">
                    <svg class="favorite-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </button>
            </div>
            <div class="nft-content">
                <h3 class="nft-title">Happy Robot 032</h3>
                <div class="nft-creator">
                    <div class="w-6 h-6 rounded-full overflow-hidden creator-badge">
                        <img src="/api/placeholder/30/30" alt="BeKind2Robots" class="w-full h-full object-cover">
                    </div>
                    <span class="creator-name">BeKind2Robots</span>
                </div>
                <div class="nft-details">
                    <div>
                        <p class="price-label">Price</p>
                        <p class="price-value">1.63 ETH</p>
                    </div>
                    <div class="text-right">
                        <p class="bid-label">Highest Bid</p>
                        <p class="bid-value">0.33 wETH</p>
                    </div>
                </div>
            </div>
            <div class="buy-button">Buy Now</div>
        </div>

        <!-- NFT Card 3 -->
     

        <!-- NFT Card 4 -->
        <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.1s;">
            <img src="{{ asset('assets/nft_images/designer_bear.png') }}" alt="Designer Bear" class="w-full h-56 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-white">Designer Bear</h3>
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                        <img src="/api/placeholder/50/50" alt="Mr Fox" class="w-full h-full object-cover">
                    </div>
                    <span class="text-sm text-gray-400 ml-2">By Mr Fox</span>
                </div>
                <div class="flex justify-between mt-4">
                    <div>
                        <p class="text-xs text-gray-400">Price</p>
                        <p class="text-sm text-white">1.63 ETH</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Highest Bid</p>
                        <p class="text-sm text-white">0.33 wETH</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- NFT Card 5 -->
        <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.2s;">
            <img src="{{ asset('assets/nft_images/trending_collection2.png') }}" alt="Colorful Dog 0356" class="w-full h-56 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-white">Colorful Dog 0356</h3>
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                        <img src="/api/placeholder/50/50" alt="Keepitreal" class="w-full h-full object-cover">
                    </div>
                    <span class="text-sm text-gray-400 ml-2">By Keepitreal</span>
                </div>
                <div class="flex justify-between mt-4">
                    <div>
                        <p class="text-xs text-gray-400">Price</p>
                        <p class="text-sm text-white">1.63 ETH</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Highest Bid</p>
                        <p class="text-sm text-white">0.33 wETH</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- NFT Card 6 -->
        <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.3s;">
            <img src="{{ asset('assets/nft_images/dancing_robot_0312.png') }}" alt="Dancing Robot 0312" class="w-full h-56 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-white">Dancing Robot 0312</h3>
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                        <img src="/api/placeholder/50/50" alt="Robotica" class="w-full h-full object-cover">
                    </div>
                    <span class="text-sm text-gray-400 ml-2">By Robotica</span>
                </div>
                <div class="flex justify-between mt-4">
                    <div>
                        <p class="text-xs text-gray-400">Price</p>
                        <p class="text-sm text-white">1.63 ETH</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Highest Bid</p>
                        <p class="text-sm text-white">0.33 wETH</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- NFT Card 7 -->
        <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.1s;">
            <img src="{{ asset('assets/nft_images/cherry_blossom_girl_035.png') }}" alt="Cherry Blossom Girl 035" class="w-full h-56 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-white">Cherry Blossom Girl 035</h3>
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                        <img src="/api/placeholder/50/50" alt="MoonDancer" class="w-full h-full object-cover">
                    </div>
                    <span class="text-sm text-gray-400 ml-2">By MoonDancer</span>
                </div>
                <div class="flex justify-between mt-4">
                    <div>
                        <p class="text-xs text-gray-400">Price</p>
                        <p class="text-sm text-white">1.63 ETH</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Highest Bid</p>
                        <p class="text-sm text-white">0.33 wETH</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- NFT Card 8 -->
        <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.2s;">
            <img src="{{ asset('assets/nft_images/space_travel.png') }}" alt="Space Travel" class="w-full h-56 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-white">Space Travel</h3>
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                        <img src="/api/placeholder/50/50" alt="NebulaKid" class="w-full h-full object-cover">
                    </div>
                    <span class="text-sm text-gray-400 ml-2">By NebulaKid</span>
                </div>
                <div class="flex justify-between mt-4">
                    <div>
                        <p class="text-xs text-gray-400">Price</p>
                        <p class="text-sm text-white">1.63 ETH</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Highest Bid</p>
                        <p class="text-sm text-white">0.33 wETH</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- NFT Card 9 -->
        <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.3s;">
            <img src="{{ asset('assets/nft_images/sunset_dimension.png') }}" alt="Sunset Dimension" class="w-full h-56 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-white">Sunset Dimension</h3>
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                        <img src="/api/placeholder/50/50" alt="Animakid" class="w-full h-full object-cover">
                    </div>
                    <span class="text-sm text-gray-400 ml-2">By Animakid</span>
                </div>
                <div class="flex justify-between mt-4">
                    <div>
                        <p class="text-xs text-gray-400">Price</p>
                        <p class="text-sm text-white">1.63 ETH</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Highest Bid</p>
                        <p class="text-sm text-white">0.33 wETH</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- NFT Card 10 -->
        <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.1s;">
            <img src="{{ asset('assets/nft_images/desert_walk.png') }}" alt="Desert Walk" class="w-full h-56 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-white">Desert Walk</h3>
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                        <img src="/api/placeholder/50/50" alt="Catch 22" class="w-full h-full object-cover">
                    </div>
                    <span class="text-sm text-gray-400 ml-2">By Catch 22</span>
                </div>
                <div class="flex justify-between mt-4">
                    <div>
                        <p class="text-xs text-gray-400">Price</p>
                        <p class="text-sm text-white">1.63 ETH</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Highest Bid</p>
                        <p class="text-sm text-white">0.33 wETH</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- NFT Card 11 -->
        <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.2s;">
            <img src="{{ asset('assets/nft_images/icecream_ape_0324.png') }}" alt="IceCream Ape 0324" class="w-full h-56 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-white">IceCream Ape 0324</h3>
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                        <img src="/api/placeholder/50/50" alt="Ice Club" class="w-full h-full object-cover">
                    </div>
                    <span class="text-sm text-gray-400 ml-2">By Ice Club</span>
                </div>
                <div class="flex justify-between mt-4">
                    <div>
                        <p class="text-xs text-gray-400">Price</p>
                        <p class="text-sm text-white">1.63 ETH</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Highest Bid</p>
                        <p class="text-sm text-white">0.33 wETH</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- NFT Card 12 -->
        <div class="nft-card rounded-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.3s;">
            <img src="{{ asset('assets/nft_images/colorful_dog_0344.png') }}" alt="Colorful Dog 0344" class="w-full h-56 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-white">Colorful Dog 0344</h3>
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                        <img src="/api/placeholder/50/50" alt="PuppyPower" class="w-full h-full object-cover">
                    </div>
                    <span class="text-sm text-gray-400 ml-2">By PuppyPower</span>
                </div>
                <div class="flex justify-between mt-4">
                    <div>
                        <p class="text-xs text-gray-400">Price</p>
                        <p class="text-sm text-white">1.63 ETH</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Highest Bid</p>
                        <p class="text-sm text-white">0.33 wETH</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>