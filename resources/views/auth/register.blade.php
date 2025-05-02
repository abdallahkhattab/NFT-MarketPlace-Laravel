@extends('layouts.layout')

@section('title', 'Create Account')

@push('styles')

<style>
    /* Custom Keyframes */
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 10px rgba(79, 70, 229, 0.5), 0 0 20px rgba(236, 72, 153, 0.3); }
        50% { box-shadow: 0 0 20px rgba(79, 70, 229, 0.8), 0 0 40px rgba(236, 72, 153, 0.5); }
    }
    @keyframes zoom {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
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
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-900 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Left Side: Image Section -->
        <div x-data="{ isHovered: false }" 
             @mousemove="isHovered = true" 
             @mouseleave="isHovered = false"
             class="relative h-96 lg:h-[600px] rounded-2xl overflow-hidden nft-container animate-pulse-glow"
             x-init="initNFTContainer($el)">
            <img src="{{ asset('assets/nft_images/register-image.png') }}" 
                 alt="NFT Space Scene" 
                 class="w-full h-full object-cover nft-image">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/70 to-transparent"></div>
            <!-- Overlay Text (Optional) -->
            <div class="absolute bottom-4 left-4 text-white animate-float">
                <h3 class="text-2xl font-bold">Explore the NFT Cosmos</h3>
                <p class="text-sm">Dive into a universe of digital art</p>
            </div>
        </div>

        <!-- Right Side: Form Section -->
        <div class="bg-gray-800 p-8 rounded-2xl shadow-xl animate-fade-in">
            <h2 class="text-4xl font-bold text-white mb-4">Create Account</h2>
            <p class="text-gray-400 mb-8">Welcome! Enter your details to start creating, collecting, and selling NFTs.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Username -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">name</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="block w-full pl-10 pr-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" 
                            placeholder="name" 
                            required
                        >
                    </div>
                    <p x-show="errors.username" x-text="errors.username" class="mt-2 text-sm text-red-500"></p>
                    @error('name')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.2a8.5 8.5 0 01-7.6-4.7" />
                            </svg>
                        </span>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            x-model="form.email" 
                            class="block w-full pl-10 pr-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" 
                            placeholder="Email Address" 
                            required
                        >
                    </div>
                    <p x-show="errors.email" x-text="errors.email" class="mt-2 text-sm text-red-500"></p>
                    @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.1.9-2 2-2s2 .9 2 2-2 4-2 4m-4-4c0-1.1.9-2 2-2s2 .9 2 2m-6 4v-1a4 4 0 014-4h0a4 4 0 014 4v1m-8 0h8" />
                            </svg>
                        </span>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            x-model="form.password" 
                            class="block w-full pl-10 pr-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" 
                            placeholder="Password" 
                            required
                        >
                    </div>
                    <p x-show="errors.password" x-text="errors.password" class="mt-2 text-sm text-red-500"></p>
                    @error('password')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-8">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.1.9-2 2-2s2 .9 2 2-2 4-2 4m-4-4c0-1.1.9-2 2-2s2 .9 2 2m-6 4v-1a4 4 0 014-4h0a4 4 0 014 4v1m-8 0h8" />
                            </svg>
                        </span>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            x-model="form.confirmPassword" 
                            class="block w-full pl-10 pr-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" 
                            placeholder="Confirm Password" 
                            required
                        >
                    </div>
                    <p x-show="errors.confirmPassword" x-text="errors.confirmPassword" class="mt-2 text-sm text-red-500"></p>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-purple-600 text-white px-6 py-4 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all">
                    Create Account
                </button>
            </form>

            <!-- Link to Login -->
            <p class="mt-6 text-center text-gray-400">
                Already have an account? <a href="{{ route('login') }}" class="text-purple-400 hover:text-purple-300">Sign in</a>
            </p>
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
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 1s ease-out forwards;
    }
</style>
@endpush