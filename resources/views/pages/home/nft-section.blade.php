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
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- NFT Card 1 -->
            <div class="nft-card rounded-2xl overflow-hidden bg-gray-800">
                <div class="h-64 overflow-hidden">
                    <img src="{{ asset('assets/nft_images/Trending.png') }}" alt="Distant Galaxy" class="w-full h-full object-cover">
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold mb-3">Distant Galaxy</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <img src="/api/placeholder/50/50" alt="MoonDancer" class="w-full h-full object-cover">
                        </div>
                        <span class="ml-2 text-gray-300">MoonDancer</span>
                    </div>
                    
                    <div class="flex justify-between mt-2 pt-3 border-t border-gray-700">
                        <div>
                            <p class="text-xs text-gray-400">Price</p>
                            <p class="font-medium">1.63 ETH</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 text-right">Highest Bid</p>
                            <p class="font-medium text-right">0.33 wETH</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- NFT Card 2 -->
            <div class="nft-card rounded-2xl overflow-hidden bg-gray-800">
                <div class="h-64 overflow-hidden">
                    <img src="{{ asset('assets/nft_images/trending_collection2.png') }}" alt="Life On Edena" class="w-full h-full object-cover">
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold mb-3">Life On Edena</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <img src="/api/placeholder/50/50" alt="NebulaKid" class="w-full h-full object-cover">
                        </div>
                        <span class="ml-2 text-gray-300">NebulaKid</span>
                    </div>
                    
                    <div class="flex justify-between mt-2 pt-3 border-t border-gray-700">
                        <div>
                            <p class="text-xs text-gray-400">Price</p>
                            <p class="font-medium">1.63 ETH</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 text-right">Highest Bid</p>
                            <p class="font-medium text-right">0.33 wETH</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- NFT Card 3 -->
            <div class="nft-card rounded-2xl overflow-hidden bg-gray-800">
                <div class="h-64 overflow-hidden">
                    <img src="/api/placeholder/400/300" alt="AstroFiction" class="w-full h-full object-cover">
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold mb-3">AstroFiction</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-primary">
                            <img src="/api/placeholder/50/50" alt="Spaceone" class="w-full h-full object-cover">
                        </div>
                        <span class="ml-2 text-gray-300">Spaceone</span>
                    </div>
                    
                    <div class="flex justify-between mt-2 pt-3 border-t border-gray-700">
                        <div>
                            <p class="text-xs text-gray-400">Price</p>
                            <p class="font-medium">1.63 ETH</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 text-right">Highest Bid</p>
                            <p class="font-medium text-right">0.33 wETH</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex justify-center mt-10 md:hidden">
            <a href="#" class="flex items-center border border-light-purple text-light-purple px-6 py-3 rounded-full hover:bg-light-purple hover:text-white transition-all">
                <i class="far fa-eye mr-2"></i> See All
            </a>
        </div>
    </div>
</section>
