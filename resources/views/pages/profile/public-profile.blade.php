@extends('layouts.layout')

@push('styles')
<style>
    /* Enhanced gradient background with subtle animation */
    .gradient-bg {
        background: linear-gradient(135deg, #6d28d9, #8b5cf6, #4c1d95);
        background-size: 200% 200%;
        animation: gradientShift 15s ease infinite;
    }
    
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .banner-img {
        height: 280px;
        object-fit: cover;
        transition: all 0.5s ease;
    }
    
    /* Hover effects */
    .hover-scale {
        transition: transform 0.3s ease;
    }
    .hover-scale:hover {
        transform: scale(1.03);
    }
    
    /* Button animations */
    .pulse-btn {
        box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.7);
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(139, 92, 246, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(139, 92, 246, 0);
        }
    }
    
    /* Smooth fade-in animations */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeIn 0.8s ease forwards;
    }
    
    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Delayed fade-in animations */
    .fade-in-1 { animation-delay: 0.1s; }
    .fade-in-2 { animation-delay: 0.2s; }
    .fade-in-3 { animation-delay: 0.3s; }
    .fade-in-4 { animation-delay: 0.4s; }
    
    /* Elegant toast notification */
    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: rgba(17, 24, 39, 0.95);
        border-left: 4px solid #8b5cf6;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        z-index: 9999;
        max-width: 350px;
        display: flex;
        align-items: center;
        overflow: hidden;
        transform: translateX(400px);
        opacity: 0;
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }
    
    .toast.show {
        transform: translateX(0);
        opacity: 1;
    }
    
    .toast-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 100%;
        background: linear-gradient(to right, #6d28d9, #8b5cf6);
        animation: toast-timer 3s linear forwards;
    }
    
    @keyframes toast-timer {
        to {
            width: 0%;
        }
    }
    
    /* Glowing effect for profile avatar */
    .avatar-glow {
        position: relative;
    }
    
    .avatar-glow::after {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        background: linear-gradient(45deg, #6d28d9, #8b5cf6, #4c1d95, #8b5cf6);
        background-size: 400% 400%;
        z-index: -1;
        border-radius: 14px;
        animation: glowingBorder 3s ease infinite;
        opacity: 0.7;
        filter: blur(5px);
    }
    
    @keyframes glowingBorder {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Tab hover effects */
    .tab-hover {
        position: relative;
        transition: all 0.3s ease;
    }
    
    .tab-hover::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 50%;
        background: #8b5cf6;
        transition: all 0.3s ease;
    }
    
    .tab-hover:hover::after {
        width: 100%;
        left: 0;
    }
    
    /* Card hover effects */
    .nft-card {
        transition: all 0.3s ease;
        transform-style: preserve-3d;
    }
    
    .nft-card:hover {
        transform: translateY(-5px) rotateX(5deg);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('content')
<div class="bg-gray-900 text-white min-h-screen">
    <!-- Banner Image with parallax effect -->
    <div class="w-full relative overflow-hidden" id="banner-container">
        <img src="{{ $profile->backgroundUrl() }}" alt="Profile Banner" class="w-full banner-img" id="parallax-banner">
        
        <!-- Enhanced gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-purple-700/40 to-purple-900/80"></div>
    </div>

    <!-- Profile Header -->
    <div class="container mx-auto px-4 -mt-16 relative z-10">
        <!-- Profile Avatar and Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8">
            <div class="flex items-end fade-in fade-in-1">
                <div class="w-32 h-32 rounded-xl overflow-hidden border-4 border-gray-900 bg-gray-800 avatar-glow">
                    <img src="{{ $profile->avatarUrl() }}" alt="Profile Avatar" class="w-full h-full object-cover">
                </div>
                <div class="ml-4 mb-2">
                    <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                    <div class="flex items-center mt-2">
                        <div 
                            class="bg-purple-600 text-white text-sm px-4 py-2 rounded-lg flex items-center cursor-pointer hover-scale"
                            onclick="copyWalletAddress('{{ $fullAddress ?? 'no address' }}')"
                            title="Click to copy full wallet address"
                        >
                            <span class="mr-2">{{ $shortAddress ?? '' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 
                                         12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 
                                          002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-4 fade-in fade-in-2">
                <button class="border border-purple-600 text-white px-6 py-3 rounded-lg flex items-center hover:bg-purple-600 transition duration-300 pulse-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Follow
                </button>
            </div>
        </div>

        <!-- Profile Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-800 rounded-xl p-6 hover-scale fade-in fade-in-1">
                <div class="text-3xl font-bold counter" data-target="250000">0</div>
                <div class="text-gray-400">Volume</div>
            </div>
            <div class="bg-gray-800 rounded-xl p-6 hover-scale fade-in fade-in-2">
                <div class="text-3xl font-bold counter" data-target="50">0</div>
                <div class="text-gray-400">NFTs Sold</div>
            </div>
            <div class="bg-gray-800 rounded-xl p-6 hover-scale fade-in fade-in-3">
                <div class="text-3xl font-bold counter" data-target="3000">0</div>
                <div class="text-gray-400">Followers</div>
            </div>
        </div>

        <!-- Profile Bio -->
        <div class="mb-8 fade-in fade-in-1">
            <h2 class="text-2xl font-bold mb-4">Bio</h2>
            <p class="text-gray-300">The Internet's Friendliest Designer Kid.</p>
        </div>

        <!-- Profile Links -->
        <div class="mb-8 fade-in fade-in-2">
            <h2 class="text-2xl font-bold mb-4">Links</h2>
            <div class="flex space-x-6">
                <a href="#" class="text-gray-400 hover:text-white transition transform hover:scale-110 duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition transform hover:scale-110 duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition transform hover:scale-110 duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition transform hover:scale-110 duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.128a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z" />
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition transform hover:scale-110 duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="flex border-b border-gray-700 mb-8 justify-center fade-in fade-in-3">
            <nav class="flex space-x-8">
                <a href="#" class="border-b-2 border-purple-600 text-white px-4 py-4 font-medium">
                    Created <span class="ml-2 bg-gray-700 px-2 py-1 rounded-lg text-sm">302</span>
                </a>
                <a href="#" class="text-gray-400 hover:text-white px-4 py-4 font-medium tab-hover">
                    Owned <span class="ml-2 bg-gray-700 px-2 py-1 rounded-lg text-sm">67</span>
                </a>
                <a href="#" class="text-gray-400 hover:text-white px-4 py-4 font-medium tab-hover">
                    Collection <span class="ml-2 bg-gray-700 px-2 py-1 rounded-lg text-sm">4</span>
                </a>
            </nav>
        </div>

        <!-- NFT Gallery Grid -->
        <div class="fade-in fade-in-4">
            <x-n-f-t-card/>
        </div>
        
        <!-- Load More Button -->
        <div class="flex justify-center mb-12 fade-in fade-in-4">
            <button class="bg-gray-800 text-white px-8 py-4 rounded-lg flex items-center hover:bg-purple-700 transition duration-300 hover-scale">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                Load More
            </button>
        </div>
    </div>
    
    <!-- Toast Notification Container -->
    <div id="toast-container"></div>
</div>

@push('scripts')
<script>
    // Enhanced copy wallet address function with elegant toast notification
    function copyWalletAddress(address) {
        navigator.clipboard.writeText(address).then(function() {
            showToast('Wallet address copied to clipboard!', 'success');
        }, function(err) {
            showToast('Failed to copy address', 'error');
            console.error('Failed to copy address: ', err);
        });
    }
    
    // Elegant toast notification function
    function showToast(message, type = 'success') {
        // Remove any existing toasts
        const existingToast = document.querySelector('.toast');
        if (existingToast) {
            existingToast.remove();
        }
        
        // Create toast elements
        const toast = document.createElement('div');
        toast.className = 'toast';
        
        // Choose icon based on type
        let icon = '';
        if (type === 'success') {
            icon = `<svg class="w-6 h-6 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>`;
        } else {
            icon = `<svg class="w-6 h-6 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>`;
        }
        
        // Set toast content
        toast.innerHTML = `
            ${icon}
            <div>
                <p class="font-medium">${message}</p>
            </div>
            <button class="ml-auto" onclick="this.parentElement.remove()">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="toast-progress"></div>
        `;
        
        // Add toast to container
        document.getElementById('toast-container').appendChild(toast);
        
        // Show toast with animation
        setTimeout(() => {
            toast.classList.add('show');
        }, 10);
        
        // Hide toast after animation
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 500);
        }, 3000);
    }
    
    // Parallax effect for banner
    document.addEventListener('DOMContentLoaded', function() {
        const banner = document.getElementById('parallax-banner');
        window.addEventListener('scroll', function() {
            const scrolled = window.scrollY;
            if (banner) {
                banner.style.transform = 'translateY(' + (scrolled * 0.25) + 'px)';
            }
        });
        
        // Animate counters
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000; // ms
            const step = target / (duration / 16); // 60fps
            
            let current = 0;
            const updateCounter = () => {
                current += step;
                if (current < target) {
                    if (target > 1000) {
                        counter.textContent = Math.floor(current).toLocaleString() + '+';
                    } else {
                        counter.textContent = Math.floor(current) + '+';
                    }
                    requestAnimationFrame(updateCounter);
                } else {
                    if (target > 1000) {
                        counter.textContent = target.toLocaleString() + '+';
                    } else {
                        counter.textContent = target + '+';
                    }
                }
            };
            
            // Start the animation when element is in viewport
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    updateCounter();
                    observer.disconnect();
                }
            });
            
            observer.observe(counter);
        });
    });
</script>
@endpush
@endsection