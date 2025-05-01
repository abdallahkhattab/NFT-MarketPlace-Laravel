@extends('welcome')
@section('content')
<!-- Hero Section -->
<section class="py-10 px-6 md:px-10">
    <div class="container mx-auto grid md:grid-cols-2 gap-10 items-center">
        <div>
            <h1 class="text-4xl md:text-5xl font-bold mb-6 typewriter" style="animation: typing 1.5s steps(40, end);">Discover Digital Art</h1>
            <h1 class="text-4xl md:text-5xl font-bold mb-6 "> & Collect NFTs</h1>
            <p class="text-gray-300 mb-8 leading-relaxed hidden-until" style="animation: fadeIn 0.3s ease-in 1.5s forwards;">Explore a vibrant marketplace created with Anima for Figma. Collect, buy, and sell art from over 20,000 NFT artists.</p>
            <a href="#" class="bg-light-purple hover:bg-purple-600 text-white py-3 px-8 rounded-full flex items-center w-max transition-colors hidden-until" style="animation: fadeIn 0.3s ease-in 1.5s forwards;">
                <i class="fas fa-rocket mr-2"></i> Get Started
            </a>
            
            <div class="grid grid-cols-3 gap-6 mt-10">
                <div>
                    <h3 class="text-3xl font-bold">240k+</h3>
                    <p class="text-gray-400">Total Sales</p>
                </div>
                <div>
                    <h3 class="text-3xl font-bold">100k+</h3>
                    <p class="text-gray-400">Auctions</p>
                </div>
                <div>
                    <h3 class="text-3xl font-bold">20k+</h3>
                    <p class="text-gray-400">Artists</p>
                </div>
            </div>
        </div>
        
        <div class="highlighted-nft-TWoRBK" data-id="I1647:23896;1318:15938" data-hotspot-id="hp-39">
            <img width="100%" height="100%" src="https://cdn.animaapp.com/projects/6357ce7c8a65b2f16659918c/files/heroanimationtransparentbck-2.gif" alt="Featured NFT">
        </div>
    </div>
</section>
<!-- Categories Section -->
@include('pages.home.categories-section')

<!-- Discover NFTs Section -->
@include('pages.home.nft-section')
<!-- NFT Showcase Section -->
@include('pages.home.nft-show')
<!-- How It Works Section -->
@include('pages.home.how-it-works-section')
<!-- Top Creators Section -->
@include('pages.home.top-creator-section')
<!-- Trending Collection Section -->
@include('pages.home.trending-colection-section')
@endsection
