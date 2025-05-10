<section class="relative w-full" style="height: 560px;">
    <!-- NFT Image - Main Feature -->
    <div class="absolute inset-0 w-full h-full overflow-hidden">
        <img src="{{ asset('assets/nft_images/magic2.png') }}" alt="Magic Mushroom NFT" class="w-full h-full object-cover object-center">
        
        <!-- Gradient overlay from transparent to purple -->
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-purple-700/30 to-purple-800/70"></div>
    </div>
    
    <div class="container mx-auto h-full relative z-10">
        <!-- Content positioned at bottom of container -->
        <div class="absolute bottom-12 left-0 right-0 px-6 md:px-10">
            <!-- Shroomie Button -->
            <div class="mb-4">
                <div class="inline-flex items-center bg-gray-800 bg-opacity-50 backdrop-blur-sm px-4 py-2 rounded-full">
                    <div class="w-6 h-6 rounded-full overflow-hidden bg-gray-700 mr-2">
                    </div>
                    <span class="text-white">Shroomie</span>
                </div>
            </div>
            
            <!-- Title -->
            <h2 class="text-5xl font-bold text-white mb-6">Magic Mushrooms</h2>
            
            <!-- See NFT Button -->
            <div>
                <a href="#" class="inline-flex items-center bg-white text-black px-6 py-3 rounded-full hover:bg-gray-200 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 mr-2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    See NFT
                </a>
            </div>
        </div>
        
        <!-- Auction Timer -->
        <div class="absolute top-8 right-8 bg-gray-800 bg-opacity-50 backdrop-blur-sm px-6 py-4 rounded-xl">
            <p class="text-sm text-gray-300 mb-1">Auction ends in:</p>
            <div class="flex items-center gap-3">
                <div class="text-center">
                    <span class="text-2xl font-bold text-white">59</span>
                    <p class="text-xs text-gray-300">Hours</p>
                </div>
                <span class="text-2xl text-white">:</span>
                <div class="text-center">
                    <span class="text-2xl font-bold text-white">59</span>
                    <p class="text-xs text-gray-300">Minutes</p>
                </div>
                <span class="text-2xl text-white">:</span>
                <div class="text-center">
                    <span class="text-2xl font-bold text-white">59</span>
                    <p class="text-xs text-gray-300">Seconds</p>
                </div>
            </div>
        </div>
    </div>

</section>
