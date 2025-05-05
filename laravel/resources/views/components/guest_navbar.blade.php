@guest

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
        <a href="{{ route('wallet-connection') }}" class="text-white hover:text-light-purple transition-colors">Connect a Wallet</a>
        <a href="{{ route('login') }}" class="bg-light-purple hover:bg-purple-600 text-white py-2 px-6 rounded-full flex items-center transition-colors">
            <i class="fas fa-user mr-2"></i> Log In
        </a>
    </div>

    <!-- Mobile Menu Button -->
    <div class="md:hidden">
        <button id="menu-toggle" class="text-white" aria-label="Toggle Menu">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </div>
        
 
 
</div>



   <!-- Mobile Menu -->
   <div id="mobile-menu" class="md:hidden hidden px-6 mt-4 space-y-4">
    <a href="{{ route('marketplace') }}" class="block text-white hover:text-light-purple">Marketplace</a>
    <a href="{{ route('ranking') }}" class="block text-white hover:text-light-purple">Rankings</a>
    <a href="{{ route("wallet-connection") }}" class="block text-white hover:text-light-purple">Connect a Wallet</a>
    <a href="{{ route('login') }}" class="block bg-light-purple hover:bg-purple-600 text-white py-2 px-6 rounded-full text-center">
        <i class="fas fa-user mr-2"></i> Log In
    </a>
</div>
       
@endguest