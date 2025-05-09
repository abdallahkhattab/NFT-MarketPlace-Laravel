@extends('layouts.layout')


@section('title','home')
@section('content')
<!-- Hero Section -->
@include('pages.home.hero')

<!-- Trending Collection Section -->
@include('pages.home.trending-colection-section')

<!-- Top Creators Section -->
@include('pages.home.top-creator-section')

<!-- Categories Section -->
@include('pages.home.categories-section')

<!-- Discover NFTs Section -->
@include('pages.home.nft-section')

<!-- NFT Showcase Section -->
@include('pages.home.nft-show')

<!-- How It Works Section -->
@include('pages.home.how-it-works-section')

@endsection
