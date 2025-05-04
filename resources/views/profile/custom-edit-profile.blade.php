@extends('layouts.layout')

@section('title', 'Edit Your Profile')

@push('styles')
<style>
    /* Enhanced Cyberpunk NFT Profile Styling */
    .nft-profile-container {
        background: linear-gradient(135deg, #13151a 0%, #1e2128 100%);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.3);
        color: #fff;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .nft-profile-container:hover {
        transform: translateY(-3px);
    }

    .nft-profile-container::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, #ff3e88 0%, #4285f4 100%);
        opacity: 0.05;
        z-index: 0;
    }

    .profile-header {
        position: relative;
        padding: 40px 20px 70px;
        background: linear-gradient(90deg, #3a2669 0%, #191b2a 100%);
        border-radius: 20px 20px 0 0;
        overflow: hidden;
    }

    .background-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.2;
        z-index: 0;
    }

    .profile-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 60px;
        background-size: cover;
        z-index: 1;
    }

    .background-upload-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #4c40f7;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        z-index: 2;
    }

    .background-upload-btn:hover {
        transform: scale(1.1);
        background: #665eff;
        box-shadow: 0 0 10px rgba(76, 64, 247, 0.5);
    }

    .avatar-section {
        position: relative;
        margin-top: -60px;
        z-index: 10;
    }

    .avatar-container {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        margin: 0 auto;
        position: relative;
        background: linear-gradient(135deg, #13151a 0%, #1e2128 100%);
        padding: 5px;
        border: 2px solid #4c40f7;
        box-shadow: 0 5px 15px rgba(76, 64, 247, 0.4);
    }

    .avatar-preview {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #1a1d26;
    }

    .avatar-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-upload-btn {
        position: absolute;
        right: 5px;
        bottom: 5px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #4c40f7;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
    }

    .avatar-upload-btn:hover {
        transform: scale(1.1);
        background: #665eff;
    }

    .form-content {
        position: relative;
        z-index: 5;
        padding: 30px;
    }

    .nft-form-group {
        margin-bottom: 26px;
        position: relative;
    }

    .nft-label {
        font-size: 14px;
        font-weight: 600;
        color: #a0a0ca;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-bottom: 8px;
        display: block;
    }

    .nft-input {
        width: 100%;
        padding: 14px 18px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: #fff;
        font-size: 16px;
        transition: all 0.3s;
    }

    .nft-input:focus {
        border-color: #4c40f7;
        box-shadow: 0 0 0 3px rgba(76, 64, 247, 0.2);
        background: rgba(255, 255, 255, 0.07);
        outline: none;
    }

    .nft-textarea {
        min-height: 130px;
        resize: vertical;
    }

    .wallet-address {
        background: rgba(76, 64, 247, 0.1);
        border: 1px solid rgba(76, 64, 247, 0.3);
        font-family: monospace;
        font-size: 14px;
        word-break: break-all;
    }

    .nft-badge {
        display: inline-block;
        padding: 4px 12px;
        background: rgba(76, 64, 247, 0.2);
        color: #8d86ff;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-left: 10px;
    }

    .nft-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .nft-stat-item {
        flex: 1;
        min-width: 100px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 12px;
        padding: 16px;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .stat-value {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
        background: linear-gradient(90deg, #ff3e88, #ffb347);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .stat-label {
        font-size: 12px;
        color: #a0a0ca;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .social-links {
        display: flex;
        gap: 10px;
        margin-top: 5px;
    }

    .social-input {
        padding-left: 40px;
    }

    .social-icon {
        position: absolute;
        left: 15px;
        top: 45px;
        opacity: 0.7;
    }

    .nft-save-btn {
        background: linear-gradient(90deg, #4c40f7, #6f42c1);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 14px 30px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(76, 64, 247, 0.3);
    }

    .nft-save-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(76, 64, 247, 0.4);
        background: linear-gradient(90deg, #5648ff, #7d4ed4);
    }

    .help-text {
        font-size: 12px;
        color: #8886ab;
        margin-top: 5px;
    }

    .nft-error-message {
        color: #ff5e7a;
        font-size: 12px;
        margin-top: 6px;
        display: block;
    }

    .success-message {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: rgba(20, 23, 34, 0.9);
        border-left: 4px solid #4caf50;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        padding: 16px 24px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 9999;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .file-input-container {
        position: absolute;
        overflow: hidden;
        width: 36px;
        height: 36px;
        opacity: 0;
    }

    .file-input-container input {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        cursor: pointer;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 52px;
        height: 26px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.1);
        transition: .4s;
        border-radius: 34px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .toggle-slider {
        background-color: #4c40f7;
    }

    input:checked + .toggle-slider:before {
        transform: translateX(26px);
    }

    .toggle-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .toggle-label {
        font-size: 14px;
        font-weight: 500;
        color: #d8d8f0;
    }

    .form-row {
        display: flex;
        gap: 20px;
    }

    .form-col {
        flex: 1;
    }

    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
        }

        .nft-profile-container {
            border-radius: 16px;
        }

        .profile-header {
            padding: 30px 15px 60px;
        }
    }
</style>
@endpush

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-disc list-inside text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="py-12 px-4">
    <div class="max-w-5xl mx-auto">
        <div class="nft-profile-container">
            <!-- Profile Header -->
            <div class="profile-header">
                    <img class="background-image" src="{{ $profile->backgroundUrl() ?? '' }}  " alt="">
               
                <h1 class="text-center text-3xl font-bold mb-2">Customize Your NFT Profile</h1>
                <p class="text-center text-gray-300 mb-4">Make your profile stand out in the NFT marketplace</p>
                <div class="background-upload-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                    </svg>
                    <div class="file-input-container">
                        <input type="file" id="background-input" name="background_image" accept="image/*" onchange="previewBackground()">
                    </div>
                </div>
            </div>
            
            <!-- Avatar Section -->
            <div class="avatar-section">
                <div class="avatar-container">
                    <div class="avatar-preview">
                        <img id="avatar-preview-image" src="{{ $profile->avatarUrl() }}">
                    </div>
                    <div class="avatar-upload-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                        </svg>
                        <div class="file-input-container">
                            <input type="file" id="avatar-input"  name="avatar" accept="image/*" onchange="previewAvatar()">
                        </div>
                    </div>
                </div>
                <p class="text-center mt-3 text-lg font-bold">{{ $user->name }}</p>
                <p class="text-center text-blue-400 text-sm">{{ '@' . str_replace(' ', '', strtolower($user->name)) }}</p>
            </div>
            
            <!-- Form Content -->
            <div class="form-content">
                <form method="post" action="{{ route('profile.update',$profile) }}" enctype="multipart/form-data" id="profile-form">
                    @csrf
                    @method('put')
                    
                    <!-- Hidden inputs -->
                    <input type="file" name="avatar" id="hidden-avatar-input" style="display: none;">
                    <input type="file" name="background_image" id="hidden-background-input" style="display: none;">
                    
                    <!-- Stats Section -->
                    <div class="nft-stats">
                        <div class="nft-stat-item">
                            <div class="stat-value">{{ $user->nfts_count ?? 0 }}</div>
                            <div class="stat-label">NFTs Owned</div>
                        </div>
                        <div class="nft-stat-item">
                            <div class="stat-value">{{ $user->created_count ?? 0 }}</div>
                            <div class="stat-label">Created</div>
                        </div>
                        <div class="nft-stat-item">
                            <div class="stat-value">{{ $user->followers_count ?? 0 }}</div>
                            <div class="stat-label">Followers</div>
                        </div>
                    </div>
                    
                    <!-- Visibility Toggle -->
                    <div class="toggle-container">
                        <span class="toggle-label">Profile Visibility</span>
                        <label class="toggle-switch">
                            <input type="checkbox" name="is_public" {{ $user->is_public ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    
                    <!-- Form Row -->
                    <div class="form-row">
                        <div class="form-col">
                            <div class="nft-form-group">
                                <label class="nft-label" for="name">Display Name</label>
                                <input type="text" id="name" name="name" class="nft-input" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <span class="nft-error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="nft-form-group">
                        <label class="nft-label" for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="nft-input" value="{{ old('email', $user->email) }}" readonly>
                        @error('email')
                            <span class="nft-error-message">{{ $message }}</span>
                        @enderror
                        
                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-2">
                                <span class="help-text">
                                    Email not verified. 
                                    <button type="submit" form="send-verification" class="text-blue-400 hover:underline">
                                        Send verification email
                                    </button>
                                </span>
                            </div>
                        @endif
                    </div>

                    
                    <div class="nft-form-group">
                        <label class="nft-label" for="bio">Bio <span class="text-gray-400 text-xs font-normal">(Max 250 chars)</span></label>
                        <textarea id="bio" name="bio" class="nft-input nft-textarea" maxlength="250" placeholder="Tell the world about your NFT journey...">{{ old('bio', $profile->bio) }}</textarea>
                        <div class="flex justify-between">
                            <span class="help-text">Express your passion for NFT art and collecting</span>
                            <span class="help-text"><span id="bio-chars">0</span>/250</span>
                        </div>
                        @error('bio')
                            <span class="nft-error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="nft-form-group">
                        <label class="nft-label" for="wallet_address">
                            Connected Wallet
                            </label>
                        <input type="text" id="wallet_address" class="nft-input wallet-address" value="{{ $wallet->wallet_address }}" readonly disabled>
                        <span class="help-text">To change your wallet, disconnect and reconnect with a new wallet</span>
                    </div>
                    
                    <!-- Social Links Section -->
                    <h3 class="text-xl font-bold mt-8 mb-4 text-white">Social Connections</h3>
                    
                    <div class="nft-form-group">
                        <label class="nft-label" for="twitter">Twitter</label>
                        <div class="relative">
                            <span class="social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                </svg>
                            </span>
                            <input type="text" id="twitter" name="twitter" class="nft-input social-input" value="{{ old('twitter', $profile->twitter) }}" placeholder="@username">
                        </div>
                    </div>
                    
                    <div class="nft-form-group">
                        <label class="nft-label" for="instagram">Instagram</label>
                        <div class="relative">
                            <span class="social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                </svg>
                            </span>
                            <input type="text" id="instagram" name="instagram" class="nft-input social-input" value="{{ old('instagram', $profile->instagram) }}" placeholder="username">
                        </div>
                    </div>
                    
                    <div class="nft-form-group">
                        <label class="nft-label" for="website">Personal Website</label>
                        <div class="relative">
                            <span class="social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
                                </svg>
                            </span>
                            <input type="url" id="website" name="personal_website" class="nft-input social-input" value="{{ old('website', $profile->personal_website) }}" placeholder="https://yourwebsite.com">
                        </div>
                    </div>
                    
                    <!-- Form Controls -->
                    <div class="flex items-center justify-between mt-10">
                        <button type="button" onclick="window.location.href='#'" class="text-gray-300 hover:text-white transition-colors">
                            Cancel
                        </button>
                        
                        <button type="submit" class="nft-save-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
                
                <!-- Hidden verification form -->
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>
            </div>
        </div>
        
        <!-- Collection Preview Section -->
        <div class="nft-profile-container mt-8">
            <div class="p-6">
                <h3 class="text-xl font-bold mb-4 text-white">Featured NFTs Preview</h3>
                <p class="text-gray-300 mb-4">Select which NFTs to showcase on your profile</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <!-- NFT preview cards would go here -->
                </div>
            </div>
        </div>
    </div>
</div>

@if (session('status') === 'profile-updated')
<div class="success-message">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#4CAF50" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </svg>
    <span>Profile updated successfully!</span>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Avatar preview functionality
    function previewAvatar() {
        const avatarInput = document.getElementById('avatar-input');
        const hiddenAvatarInput = document.getElementById('hidden-avatar-input');
        const avatarPreview = document.getElementById('avatar-preview-image');
        
        if (avatarInput.files && avatarInput.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                avatarPreview.src = e.target.result;
            }
            
            reader.readAsDataURL(avatarInput.files[0]);
            
            // Copy the file to the hidden input for form submission
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(avatarInput.files[0]);
            hiddenAvatarInput.files = dataTransfer.files;
        }
    }

    // Background image preview functionality
    function previewBackground() {
        const backgroundInput = document.getElementById('background-input');
        const hiddenBackgroundInput = document.getElementById('hidden-background-input');
        let backgroundImage = document.querySelector('.background-image');
        
        if (backgroundInput.files && backgroundInput.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                if (!backgroundImage) {
                    backgroundImage = document.createElement('img');
                    backgroundImage.className = 'background-image';
                    document.querySelector('.profile-header').prepend(backgroundImage);
                }
                backgroundImage.src = e.target.result;
            }
            
            reader.readAsDataURL(backgroundInput.files[0]);
            
            // Copy the file to the hidden input for form submission
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(backgroundInput.files[0]);
            hiddenBackgroundInput.files = dataTransfer.files;
        }
    }
    
    // Make functions globally available
    window.previewAvatar = previewAvatar;
    window.previewBackground = previewBackground;
    
    // Character counter for bio
    const bioTextarea = document.getElementById('bio');
    const bioCharsSpan = document.getElementById('bio-chars');
    
    bioTextarea.addEventListener('input', function() {
        const charCount = this.value.length;
        bioCharsSpan.textContent = charCount;
        
        if (charCount > 240) {
            bioCharsSpan.classList.add('text-yellow-500');
        } else {
            bioCharsSpan.classList.remove('text-yellow-500');
        }
        
        if (charCount > 250) {
            bioCharsSpan.classList.add('text-red-500');
        } else {
            bioCharsSpan.classList.remove('text-red-500');
        }
    });
    
    // Trigger input event to initialize the counter
    bioTextarea.dispatchEvent(new Event('input'));
    
    // Auto hide success message
    const successMessage = document.querySelector('.success-message');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.opacity = '0';
            successMessage.style.transform = 'translateY(10px)';
            successMessage.style.transition = 'opacity 0.5s, transform 0.5s';
            
            setTimeout(() => {
                successMessage.remove();
            }, 500);
        }, 3000);
    }
});
</script>
@endsection