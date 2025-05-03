<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
.typewriter {
overflow: hidden;
white-space: nowrap;
}

.hidden-until {
opacity: 0;
visibility: hidden;
}

@keyframes typing {
from { width: 0; }
to { width: 100%; }
}

@keyframes fadeIn {
to { opacity: 1; visibility: visible; }
}
    
    body {
        font-family: 'Space Mono', monospace;
        background-color: #1a1a1a;
        color: white;
    }
    
    .category-card {
        transition: all 0.3s ease;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    
    .nft-card {
        transition: all 0.3s ease;
    }
    
    .nft-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    
    .creator-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(162, 89, 255, 0.1);
    }
    
    .creator-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(162, 89, 255, 0.2);
        border-color: rgba(162, 89, 255, 0.3);
    }

    .creator-rank {
        background: linear-gradient(45deg, #a259ff, #8e42f5);
        box-shadow: 0 4px 10px rgba(162, 89, 255, 0.3);
    }

    .typewriter {
        overflow: hidden;
        white-space: nowrap;
        animation: typing 3.5s steps(40, end);
    }

    @keyframes typing {
        from { width: 0; }
        to { width: 100%; }
    }
</style>