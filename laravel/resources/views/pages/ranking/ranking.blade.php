@extends('layouts.layout')

@push('styles')
<style>

    
    
    /* Loading Animation for Grid */
    .grid-loading {
        animation: fadeIn 0.8s ease-out forwards;
    }
    
    /* Empty State & Load More */
    .load-more-btn {
        background: linear-gradient(45deg, #2a2a2a, #3a3a3a);
        border: 1px solid rgba(162, 89, 255, 0.3);
        color: white;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .load-more-btn:hover {
        background: linear-gradient(45deg, #a259ff, #7b45e7);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(123, 69, 231, 0.3);
    }
    
    /* Responsive breakpoints refinements */
    @media (max-width: 768px) {
        .nft-card {
            max-width: none;
        }
        .stats-item {
            margin-bottom: 8px;
        }
        .stats-item:after {
            display: none;
        }
    }
    /* Ranking Section Styles */
    .ranking-section {
        margin-bottom: 4rem;
        padding: 2rem 0;
        position: relative;
        overflow: hidden;
    }

    /* Decorative background elements */
    .ranking-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 20% 30%, rgba(139, 92, 246, 0.15), transparent 50%);
        z-index: -1;
    }

    .section-header {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 2rem;
        position: relative;
    }

    .section-header h2 {
        font-size: 2.5rem;
        font-weight: 800;
        text-align: center;
        background: linear-gradient(45deg, #8b5cf6, #ec4899, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: -0.025em;
        position: relative;
        padding: 0.5rem 1rem;
        text-transform: uppercase;
        font-family: 'Inter', sans-serif;
    }

    .section-header h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 3px;
        background: linear-gradient(to right, transparent, #8b5cf6, transparent);
        border-radius: 2px;
    }

    .section-header a {
        position: absolute;
        right: 0;
        color: #a78bfa;
        text-decoration: none;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 9999px;
        transition: all 0.3s ease;
        border: 2px solid #6d28d9;
        background: linear-gradient(to right, rgba(107, 33, 168, 0.1), rgba(167, 139, 250, 0.1));
    }

    .section-header a:hover {
        background: linear-gradient(to right, rgba(107, 33, 168, 0.3), rgba(167, 139, 250, 0.3));
        color: #f3e8ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    .section-description {
        color: #d4d4d8;
        margin: 0 auto 2.5rem;
        font-size: 1.125rem;
        max-width: 600px;
        text-align: center;
        line-height: 1.6;
        font-style: italic;
    }

    /* Artist Ranking List */
    .ranking-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        padding: 0 1rem;
    }

    .ranking-card {
        background: linear-gradient(135deg, rgba(31, 41, 55, 0.9), rgba(17, 24, 39, 0.9));
        border-radius: 1.5rem;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .ranking-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(139, 92, 246, 0.05), transparent);
        z-index: -1;
    }

    .ranking-card:hover {
        transform: translateY(-6px) scale(1.02);
        box-shadow: 0 25px 30px -10px rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(139, 92, 246, 0.3);
    }

    .rank-number {
        width: 3rem;
        height: 3rem;
        background: linear-gradient(to bottom, #6d28d9, #4c1d95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #f3e8ff;
        margin-right: 1.25rem;
        font-size: 1.25rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .artist-info {
        display: flex;
        align-items: center;
        flex: 1;
    }

    .artist-avatar {
        width: 4rem;
        height: 4rem;
        border-radius: 1.25rem;
        overflow: hidden;
        margin-right: 1.25rem;
        position: relative;
        border: 2px solid rgba(139, 92, 246, 0.2);
    }

    .artist-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .ranking-card:hover .artist-avatar img {
        transform: scale(1.1) rotate(2deg);
    }

    .artist-avatar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 1.25rem;
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.15);
        transition: box-shadow 0.3s ease;
    }

    .ranking-card:hover .artist-avatar::after {
        box-shadow: inset 0 0 0 2px rgba(139, 92, 246, 0.3);
    }

    .artist-name {
        font-weight: 700;
        color: #f9fafb;
        font-size: 1.25rem;
        margin-bottom: 0.3rem;
        letter-spacing: -0.025em;
    }

    .artist-username {
        color: #d4d4d8;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .artist-stats {
        display: flex;
        gap: 2.5rem;
        align-items: center;
    }

    .stat {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .stat-label {
        font-size: 0.85rem;
        color: #d4d4d8;
        margin-bottom: 0.3rem;
        font-weight: 500;
    }

    .stat-value {
        font-weight: 700;
        font-size: 1rem;
        color: #f9fafb;
    }

    .change-value {
        color: #10b981;
        display: flex;
        align-items: center;
        font-weight: 600;
    }

    .change-value svg {
        width: 1.25rem;
        height: 1.25rem;
        margin-right: 0.3rem;
        fill: #10b981;
    }

    .nft-value {
        color: #f9fafb;
        font-weight: 600;
    }

    .eth-value {
        color: #f9fafb;
        display: flex;
        align-items: center;
        font-weight: 600;
    }

    .eth-icon {
        width: 1rem;
        height: 1rem;
        margin-right: 0.3rem;
        opacity: 0.85;
        fill: #a78bfa;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .ranking-card {
            flex-direction: column;
            align-items: flex-start;
            padding: 1.25rem;
        }

        .artist-stats {
            margin-top: 1.25rem;
            width: 100%;
            justify-content: space-between;
            gap: 1rem;
        }

        .rank-number {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            margin: 0;
            width: 2.5rem;
            height: 2.5rem;
            font-size: 1rem;
        }

        .artist-info {
            margin-top: 1.25rem;
        }

        .section-header h2 {
            font-size: 2rem;
        }
    }

    @media (min-width: 768px) {
        .ranking-list {
            grid-template-columns: repeat(1, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .ranking-list {
            grid-template-columns: repeat(1, 1fr);
        }
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4">
    <!-- Top Creators Section -->
    <div class="ranking-section">
        <div class="section-header">
            <h2>Top Creators</h2>
            <a href="#">Explore All</a>
        </div>
        <p class="section-description">Discover the most influential NFT artists shaping the future of digital art on our marketplace.</p>
        
        <!-- Artists Ranking List -->
        <div class="ranking-list">
            <!-- Artist 1 -->
            <div class="ranking-card">
                <div class="rank-number">1</div>
                <div class="artist-info">
                    <div class="artist-avatar">
                        <img src="https://via.placeholder.com/100" alt="Jaydon Ekstrom Bothman">
                    </div>
                    <div>
                        <div class="artist-name">Jaydon Ekstrom Bothman</div>
                        <div class="artist-username">@jaydone</div>
                    </div>
                </div>
                <div class="artist-stats">
                    <div class="stat">
                        <div class="stat-label">Change</div>
                        <div class="stat-value change-value">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 012 0v.59l3.3-3.3a1 1 0 011.4 0l3.3 3.3V5a1 1 0 112 0v2z" clip-rule="evenodd" />
                            </svg>
                            +1.41%
                        </div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">NFTs Sold</div>
                        <div class="stat-value nft-value">602</div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">Volume</div>
                        <div class="stat-value eth-value">
                            <svg class="eth-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" fill="currentColor">
                                <path d="M311.9 260.8L160 353.6 8 260.8 160 0l151.9 260.8zM160 383.4L8 290.6 160 512l152-221.4-152 92.8z"/>
                            </svg>
                            12.4 ETH
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Artist 2 -->
            <div class="ranking-card">
                <div class="rank-number">2</div>
                <div class="artist-info">
                    <div class="artist-avatar">
                        <img src="https://via.placeholder.com/100" alt="Ruben Carder">
                    </div>
                    <div>
                        <div class="artist-name">Ruben Carder</div>
                        <div class="artist-username">@rubencarder</div>
                    </div>
                </div>
                <div class="artist-stats">
                    <div class="stat">
                        <div class="stat-label">Change</div>
                        <div class="stat-value change-value">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 012 0v.59l3.3-3.3a1 1 0 011.4 0l3.3 3.3V5a1 1 0 112 0v2z" clip-rule="evenodd" />
                            </svg>
                            +1.41%
                        </div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">NFTs Sold</div>
                        <div class="stat-value nft-value">602</div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">Volume</div>
                        <div class="stat-value eth-value">
                            <svg class="eth-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" fill="currentColor">
                                <path d="M311.9 260.8L160 353.6 8 260.8 160 0l151.9 260.8zM160 383.4L8 290.6 160 512l152-221.4-152 92.8z"/>
                            </svg>
                            12.4 ETH
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Artist 3 -->
            <div class="ranking-card">
                <div class="rank-number">3</div>
                <div class="artist-info">
                    <div class="artist-avatar">
                        <img src="https://via.placeholder.com/100" alt="Alfredo Septimus">
                    </div>
                    <div>
                        <div class="artist-name">Alfredo Septimus</div>
                        <div class="artist-username">@alfredo</div>
                    </div>
                </div>
                <div class="artist-stats">
                    <div class="stat">
                        <div class="stat-label">Change</div>
                        <div class="stat-value change-value">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 012 0v.59l3.3-3.3a1 1 0 011.4 0l3.3 3.3V5a1 1 0 112 0v2z" clip-rule="evenodd" />
                            </svg>
                            +1.41%
                        </div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">NFTs Sold</div>
                        <div class="stat-value nft-value">602</div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">Volume</div>
                        <div class="stat-value eth-value">
                            <svg class="eth-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" fill="currentColor">
                                <path d="M311.9 260.8L160 353.6 8 260.8 160 0l151.9 260.8zM160 383.4L8 290.6 160 512l152-221.4-152 92.8z"/>
                            </svg>
                            12.4 ETH
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Artist 4 -->
            <div class="ranking-card">
                <div class="rank-number">4</div>
                <div class="artist-info">
                    <div class="artist-avatar">
                        <img src="https://via.placeholder.com/100" alt="Davis Franci">
                    </div>
                    <div>
                        <div class="artist-name">Davis Franci</div>
                        <div class="artist-username">@davisfranci</div>
                    </div>
                </div>
                <div class="artist-stats">
                    <div class="stat">
                        <div class="stat-label">Change</div>
                        <div class="stat-value change-value">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 012 0v.59l3.3-3.3a1 1 0 011.4 0l3.3 3.3V5a1 1 0 112 0v2z" clip-rule="evenodd" />
                            </svg>
                            +1.41%
                        </div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">NFTs Sold</div>
                        <div class="stat-value nft-value">602</div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">Volume</div>
                        <div class="stat-value eth-value">
                            <svg class="eth-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" fill="currentColor">
                                <path d="M311.9 260.8L160 353.6 8 260.8 160 0l151.9 260.8zM160 383.4L8 290.6 160 512l152-221.4-152 92.8z"/>
                            </svg>
                            12.4 ETH
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Artist 5 -->
            <div class="ranking-card">
                <div class="rank-number">5</div>
                <div class="artist-info">
                    <div class="artist-avatar">
                        <img src="https://via.placeholder.com/100" alt="Livia Rosser">
                    </div>
                    <div>
                        <div class="artist-name">Livia Rosser</div>
                        <div class="artist-username">@liviarosser</div>
                    </div>
                </div>
                <div class="artist-stats">
                    <div class="stat">
                        <div class="stat-label">Change</div>
                        <div class="stat-value change-value">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 012 0v.59l3.3-3.3a1 1 0 011.4 0l3.3 3.3V5a1 1 0 112 0v2z" clip-rule="evenodd" />
                            </svg>
                            +1.41%
                        </div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">NFTs Sold</div>
                        <div class="stat-value nft-value">602</div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">Volume</div>
                        <div class="stat-value eth-value">
                            <svg class="eth-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" fill="currentColor">
                                <path d="M311.9 260.8L160 353.6 8 260.8 160 0l151.9 260.8zM160 383.4L8 290.6 160 512l152-221.4-152 92.8z"/>
                            </svg>
                            12.4 ETH
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

   
</div>
@endsection