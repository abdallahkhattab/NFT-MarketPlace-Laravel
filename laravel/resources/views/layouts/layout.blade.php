<!DOCTYPE html>
<html lang="en">
<head>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ethers/6.13.5/ethers.umd.min.js" integrity="sha512-dj/EbePKIJrkhHMePgJ6ACP0v5whCZi+A8ot7WP+L0a3sPafqqWRiRhBBlGprs5hs5JjOYuTDlOic+qKc/s3mw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <meta name="csrf-token" content="{{ csrf_token() }}">
 @include('pages.head')
 @stack('styles')
</head>
<body class="bg-dark min-h-screen">
    <!-- Header/Navigation Bar -->
   <x-navbar/>

    @yield('content')

    <!-- Footer Section -->
  <x-footer/>
  @stack('scripts')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
<script>
// Particle Background Animation
function createParticles() {
    const particleBg = document.getElementById('particle-bg');
    for (let i = 0; i < 50; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.animationDelay = `${Math.random() * 10}s`;
        particle.style.animationDuration = `${5 + Math.random() * 10}s`;
        particleBg.appendChild(particle);
    }
}

// Auction Timer
function updateTimer() {
    const endTime = new Date('2025-05-10T00:00:00Z').getTime();
    const now = new Date().getTime();
    const timeLeft = endTime - now;

    if (timeLeft <= 0) {
        document.getElementById('hours').textContent = '00';
        document.getElementById('minutes').textContent = '00';
        document.getElementById('seconds').textContent = '00';
        return;
    }

    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

    document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
    document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
}

// Modal Functionality
function openModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('nftModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    gsap.from('#modalImage', { scale: 0.8, opacity: 0, duration: 0.5, ease: 'power2.out' });
}

function closeModal() {
    gsap.to('#modalImage', {
        scale: 0.8,
        opacity: 0,
        duration: 0.3,
        ease: 'power2.in',
        onComplete: () => {
            document.getElementById('nftModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });
}

// Show Toast Notification
function showToast() {
    const toast = document.getElementById('toast');
    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// Disable Context Menu on NFT Images
function disableContextMenu() {
    const nftImages = document.querySelectorAll('.nft-image');
    nftImages.forEach(img => {
        img.addEventListener('contextmenu', (e) => {
            e.preventDefault();
            showToast();
        });
    });
}

// Card Tilt Effect and Initialization
document.addEventListener('DOMContentLoaded', function() {
    createParticles();
    updateTimer();
    setInterval(updateTimer, 1000);
    disableContextMenu();

    const cards = document.querySelectorAll('.holographic-card');
    cards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;

            gsap.to(card, {
                rotationX: rotateX,
                rotationY: rotateY,
                duration: 0.3,
                ease: 'power2.out',
                transformPerspective: 1000
            });
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                rotationX: 0,
                rotationY: 0,
                duration: 0.5,
                ease: 'power2.out'
            });
        });
    });

    // Make all NFT images clickable
    const mainImage = document.querySelector('[alt="The Orbitians NFT"]');
    if (mainImage) {
        mainImage.classList.add('cursor-pointer');
    }

    const galleryImages = document.querySelectorAll('.grid .holographic-card img');
    galleryImages.forEach(img => {
        img.classList.add('cursor-pointer');
    });
});
</script>
  
</body>
</html>