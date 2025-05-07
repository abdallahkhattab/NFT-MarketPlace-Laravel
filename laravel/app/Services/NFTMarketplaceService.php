<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class NFTMarketplaceService
{
    protected $web3Provider;
    protected $contractAddress;
    protected $contractABI;
    
    public function __construct()
    {

        // Use environment variables for configuration
        $this->web3Provider = 'https://eth-sepolia.g.alchemy.com/v2/' . env('ALCHEMY_SEPOLIA_API_KEY', 'default_key_here');
        
        // Load contract address from file
        $contractAddressFile = base_path('resources/contracts/contract-address.json');
        $this->contractAddress = json_decode(File::get($contractAddressFile), true)['NFTMarketplace'] ?? null;
        
        // Load contract ABI from file
        $contractABIFile = base_path('resources/contracts/nftmarketplace.json');
        $contractData = json_decode(File::get($contractABIFile), true);
        $this->contractABI = json_encode($contractData['abi']);
    }
    
    /**
     * Get the contract address
     */
    public function getContractAddress()
    {
        return $this->contractAddress;
    }
    
    /**
     * Get the contract ABI
     */
    public function getContractABI()
    {
        return $this->contractABI;
    }
    
    /**
     * Get web3 configuration for frontend
     */
    public function getWeb3Config()
    {
        return [
            'provider' => $this->web3Provider,
            'contractAddress' => $this->contractAddress,
            'contractABI' => json_decode($this->contractABI, true)
        ];
    }
}