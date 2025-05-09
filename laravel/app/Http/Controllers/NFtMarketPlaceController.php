<?php

namespace App\Http\Controllers;

use Web3\Web3;
use Web3\Utils;
use Web3\Contract;
use Illuminate\Http\Request;
use App\Services\PinataService;
use App\Services\NFTMarketplaceService;

class NFtMarketPlaceController extends Controller
{
    protected $nftService;
    protected $pinataService;
    
    public function __construct(NFTMarketplaceService $nftService, PinataService $pinataService)
    {
        $this->nftService = $nftService;
        $this->pinataService = $pinataService;
    }
    
    /**
     * Display NFT marketplace main page
     */
    public function index()
    {
        $web3Config = $this->nftService->getWeb3Config();
        
        return view('pages.home.home', [
            'web3Config' => $web3Config
        ]);
    }
    
    /**
     * Display user's NFTs page
     */
    public function myNFTs()
    {
        $web3Config = $this->nftService->getWeb3Config();
        
        return view('nft.my-nfts', [
            'web3Config' => $web3Config
        ]);
    }


    public function ListNft()
    {
        $web3Config = $this->nftService->getWeb3Config();

       return view('pages.marketplace.marketplace',[
        'web3Config'=> $web3Config,
       ]);
    }


 /**
     * Display specific NFT details
     */
  
     public function showNFT($tokenId)
     {
         $web3Config = $this->nftService->getWeb3Config();
     
         // Get seller data
     
         // Minimal NFT data to pass to view
         $nftData = [
             'tokenId' => $tokenId,
             'name' => "Token #{$tokenId}",
             'description' => 'Loading metadata...',
             'image' => 'https://via.placeholder.com/400x400?text=Loading+NFT',
             'category' => 'Unknown',
             'price' => '0.0',
             'seller' => 'Unknown',  // Pass seller info here
             'mintedAt' => 'Unknown',
         ];
         $artist = null;
         
         return view('pages.NFT.show', [
             'web3config' => $web3Config,
             'nft' => $nftData,
             'artist'=> $artist,
         ]);
     }
             
    /**
     * Display create NFT form
     */
    public function create()
    {
        $web3Config = $this->nftService->getWeb3Config();
        
        return view('pages.NFT.create', [
            'web3Config' => $web3Config
        ]);
    }
    
    /**
     * Handle NFT image upload to IPFS
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
        'image' => 'required|image|mimes:jpeg,png,gif|max:10240',
        ]);
        
        // Upload to IPFS via Pinata
        $ipfsHash = $this->pinataService->uploadFile($request->file('image'));
        
        if (!$ipfsHash) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image to IPFS'
            ], 500);
        }
        
        // Get IPFS URL
        $ipfsUrl = $this->pinataService->getIpfsUrl($ipfsHash);
        
        return response()->json([
            'success' => true,
            'imageUrl' => $ipfsUrl,
            'ipfsHash' => $ipfsHash
        ]);
    }
    
    /**
     * Create NFT metadata and upload to IPFS
     */
    public function createMetadata(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:1000',
            'imageHash' => 'required|string'
        ]);
        
        // Prepare metadata
        $metadata = [
            'name' => $request->name,
            'description' => $request->description,
            'image' => "ipfs://{$request->imageHash}"
        ];
        
        // Add any additional attributes if needed
        if ($request->has('attributes') && is_array($request->attributes)) {
            $metadata['attributes'] = $request->attributes;
        }
        
        // Upload metadata to IPFS
        $metadataHash = $this->pinataService->uploadMetadata(
            $metadata, 
            "nft-{$request->name}-" . time() . ".json"
        );
        
        if (!$metadataHash) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload metadata to IPFS'
            ], 500);
        }
        
        return response()->json([
            'success' => true,
            'metadataUrl' => "ipfs://{$metadataHash}",
            'metadataHash' => $metadataHash,
            'tokenURI' => "ipfs://{$metadataHash}"
        ]);
    }
    
    /**
     * Get Web3 configuration for JavaScript
     */
    public function getWeb3Config()
    {
        return response()->json($this->nftService->getWeb3Config());
    }

}
