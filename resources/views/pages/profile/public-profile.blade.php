@extends('layouts.layout')

@push('styles')
<style>
    .gradient-bg {
        background: linear-gradient(to right, #6d28d9, #8b5cf6);
    }
    .banner-img {
        height: 240px;
        object-fit: cover;
    }
</style>
@endpush

@section('content')
<div class="bg-gray-900 text-white min-h-screen">
    <!-- Banner Image -->
 

    <div class="w-full relative">
        <img src="{{ asset('assets/nft_images/magic2.png') }}" alt="Profile Banner" class="w-full banner-img">
        
        <!-- Gradient overlay from transparent to purple -->
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-purple-700/30 to-purple-800/70"></div>
    </div>

    

    <!-- Profile Header -->
    <div class="container mx-auto px-4 -mt-16 relative z-10">
        <!-- Profile Avatar and Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8">
            <div class="flex items-end">
                <div class="w-32 h-32 rounded-xl overflow-hidden border-4 border-gray-900 bg-gray-800">
                    <img src="{{ asset('assets/nft_images/Avatar1.png') }}" alt="Profile Avatar" class="w-full h-full object-cover">
                </div>
                <div class="ml-4 mb-2">
                    <h1 class="text-3xl font-bold">Animakid</h1>
                    <div class="flex items-center mt-2">
                        <div class="bg-purple-600 text-white text-sm px-4 py-2 rounded-lg flex items-center">
                            <span class="mr-2">0xc0E3...B79C</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-4">
                <button class="border border-purple-600 text-white px-6 py-3 rounded-lg flex items-center hover:bg-purple-600 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Follow
                </button>
            </div>
        </div>

        <!-- Profile Stats -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-800 rounded-xl p-6">
                <div class="text-3xl font-bold">250k+</div>
                <div class="text-gray-400">Volume</div>
            </div>
            <div class="bg-gray-800 rounded-xl p-6">
                <div class="text-3xl font-bold">50+</div>
                <div class="text-gray-400">NFTs Sold</div>
            </div>
            <div class="bg-gray-800 rounded-xl p-6">
                <div class="text-3xl font-bold">3000+</div>
                <div class="text-gray-400">Followers</div>
            </div>
        </div>

        <!-- Profile Bio -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Bio</h2>
            <p class="text-gray-300">The Internet's Friendliest Designer Kid.</p>
        </div>

        <!-- Profile Links -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Links</h2>
            <div class="flex space-x-6">
                <a href="#" class="text-gray-400 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.128a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z" />
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class=" flex border-b border-gray-700 mb-8 justify-center">
            <nav class="flex space-x-8">
                <a href="#" class="border-b-2 border-purple-600 text-white px-4 py-4 font-medium">
                    Created <span class="ml-2 bg-gray-700 px-2 py-1 rounded-lg text-sm">302</span>
                </a>
                <a href="#" class="text-gray-400 hover:text-white px-4 py-4 font-medium">
                    Owned <span class="ml-2 bg-gray-700 px-2 py-1 rounded-lg text-sm">67</span>
                </a>
                <a href="#" class="text-gray-400 hover:text-white px-4 py-4 font-medium">
                    Collection <span class="ml-2 bg-gray-700 px-2 py-1 rounded-lg text-sm">4</span>
                </a>
            </nav>
        </div>

        <!-- NFT Gallery Grid -->
        <x-n-f-t-card/>
        <!-- Load More Button -->
        <div class="flex justify-center mb-12 ">
            <button class="bg-gray-800 text-white px-8 py-4 rounded-lg flex items-center hover:bg-gray-700 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                Load More
            </button>
        </div>
    </div>
</div>
@endsection