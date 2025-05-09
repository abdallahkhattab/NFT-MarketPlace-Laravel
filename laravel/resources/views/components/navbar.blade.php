
<header class="bg-darker py-4 px-6 md:px-10">
    @include('components.guest_navbar')

    @auth
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center gap-2">
            <div class="w-6 h-6 bg-light-purple rounded-md flex items-center justify-center">
                <i class="fas fa-store text-white text-xs"></i>
            </div>
            <a href="{{ route('home') }}" class="text-white font-bold text-lg">NFT Marketplace</a>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center space-x-6">
            <a href="{{ route('marketplace') }}" class="text-white hover:text-light-purple transition-colors">Marketplace</a>
            <a href="{{ route('ranking') }}" class="text-white hover:text-light-purple transition-colors">Rankings</a>
            <!-- Create NFT Button -->
            <a href="{{ route('create-nft') }}" class="create-nft-button relative text-white font-medium text-sm px-5 py-2.5 rounded-lg bg-gradient-to-r from-light-purple to-blue-600 hover:from-purple-600 hover:to-blue-700 focus:ring-2 focus:ring-purple-400 transition-all duration-300 transform hover:scale-105">
                <span class="flex items-center">
                    <i class="fas fa-coins mr-2 text-yellow-300"></i> Create NFT
                </span>
            </a>
            <a href="{{ route('wallet-connection') }}" class="text-white hover:text-light-purple transition-colors">Connect a Wallet</a>

            <!-- Desktop Dropdown Button -->
            <div class="relative">
                <button id="userDropdownButton" class="flex items-center space-x-2 text-white bg-light-purple hover:bg-purple-600 focus:ring-2 focus:ring-purple-300 focus:outline-none font-medium rounded-lg text-sm px-4 py-3 text-center" type="button">
                    <span>{{ auth()->user()->name }}</span>
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>

                <!-- Desktop Dropdown Menu -->
                <div id="userDropdownMenu" class="hidden absolute right-0 z-10 mt-2 bg-gray divide-y divide-gray-100 rounded-lg shadow-lg w-48 dark:bg-gray-800 dark:divide-gray-700">
                    <div class="px-4 py-3 text-sm text-white-900 dark:text-white">
                        <div class="font-semibold">{{ auth()->user()->name }}</div>
                        <div class="truncate text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</div>
                    </div>
                    <ul class="py-2 text-sm text-gray-500 dark:text-gray-200">
                        <li>
                            <a href="{{ route('public-profile', ['user' => Auth()->user()->name]) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">My Profile</a>
                        </li>
                        @php
                            $profile = Auth::user()->profile;
                        @endphp
                        @if ($profile)
                        <li>
                            <a href="{{ route('profile.edit', ['profile' => $profile]) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Edit Profile</a>
                        </li>
                        @endif
                    </ul>
                    <div class="py-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-red-500">
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button id="menu-toggle" class="text-white" aria-label="Toggle Menu">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden px-6 mt-4 space-y-4 pb-4">
        <a href="{{ route('marketplace') }}" class="block text-white hover:text-light-purple py-2">Marketplace</a>
        <a href="{{ route('ranking') }}" class="block text-white hover:text-light-purple py-2">Rankings</a>
        <!-- Mobile Create NFT Button -->
        <a href="{{ route('create-nft') }}" class="create-nft-button block text-white font-medium text-sm px-4 py-2 rounded-lg bg-gradient-to-r from-light-purple to-blue-600 hover:from-purple-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105">
            <span class="flex items-center">
                <i class="fas fa-coins mr-2 text-yellow-300"></i> Create NFT
            </span>
        </a>
        <a href="{{ route('wallet-connection') }}" class="block text-white hover:text-light-purple py-2">Connect a Wallet</a>

        <!-- Mobile User Profile Section -->
        <div class="mt-2 pt-2 border-t border-gray-700">
            <div class="flex items-center py-2">
                <div class="w-8 h-8 bg-light-purple rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div>
                    <p class="text-gray-400 font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-gray-400 text-sm truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <a href="{{ route('public-profile', ['user' => Auth()->user()->name]) }}" class="block text-gray-400 hover:text-light-purple py-2 pl-11">My Profile</a>
            @php
                $profile = Auth::user()->profile;
            @endphp
            @if ($profile)
            <a href="{{ route('profile.edit', ['profile' => $profile]) }}" class="block text-gray-400 hover:text-light-purple py-2 pl-11">Edit Profile</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full bg-light-purple hover:bg-purple-600 text-white py-2 px-4 rounded-lg text-sm font-medium flex items-center">
                    <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                </button>
            </form>
        </div>
    </div>
    @endauth
</header>

@push('styles')
<style>
    /* Create NFT Button Styles */
    .create-nft-button {
        font-family: 'Orbitron', sans-serif;
        background: linear-gradient(45deg, #a259ff, #3b82f6);
        border: 1px solid transparent;
        border-image: linear-gradient(to right, #a259ff, #3b82f6) 1;
        box-shadow: 0 0 10px rgba(162, 89, 255, 0.5), 0 0 20px rgba(59, 130, 246, 0.3);
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .create-nft-button::before {
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

    .create-nft-button:hover::before {
        left: 100%;
    }

    .create-nft-button:hover {
        box-shadow: 0 0 15px rgba(162, 89, 255, 0.8), 0 0 30px rgba(59, 130, 246, 0.5);
    }

    /* Particle Sparkle Effect */
    .create-nft-button::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10"><circle cx="5" cy="5" r="2" fill="rgba(255,255,255,0.5)"/></svg>') repeat;
        opacity: 0;
        animation: sparkle 2s infinite;
        z-index: -1;
    }

    @keyframes sparkle {
        0% { opacity: 0; transform: translate(0, 0); }
        50% { opacity: 0.3; transform: translate(2px, 2px); }
        100% { opacity: 0; transform: translate(0, 0); }
    }

    /* Ensure mobile button fits */
    @media (max-width: 768px) {
        .create-nft-button {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Mobile menu toggle
    document.getElementById("menu-toggle").addEventListener("click", function () {
        const menu = document.getElementById("mobile-menu");
        menu.classList.toggle("hidden");
    });

    // User dropdown toggle
    const userDropdownButton = document.getElementById("userDropdownButton");
    const userDropdownMenu = document.getElementById("userDropdownMenu");

    if (userDropdownButton && userDropdownMenu) {
        userDropdownButton.addEventListener("click", function() {
            userDropdownMenu.classList.toggle("hidden");
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", function(event) {
            if (!userDropdownButton.contains(event.target) && !userDropdownMenu.contains(event.target)) {
                userDropdownMenu.classList.add("hidden");
            }
        });
    }
</script>
@endpush
