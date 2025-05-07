<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class PinataService
{
    protected $apiKey;
    protected $apiSecret;
    protected $baseUrl = 'https://api.pinata.cloud';
    
    public function __construct()
    {
        $this->apiKey = env('PINATA_API_KEY');
        $this->apiSecret = env('PINATA_API_SECRET');
    }
    
    /**
     * Upload a file to IPFS via Pinata
     *
     * @param UploadedFile $file The file to upload
     * @param string $name Optional name for the file
     * @return string|null IPFS CID (hash) or null on failure
     */
    public function uploadFile(UploadedFile $file, $name = null)
    {
        try {
            // Store file temporarily
            $path = $file->store('temp_uploads', 'local');
            $fullPath = Storage::disk('local')->path($path);
            
            // Prepare file for Pinata
            $filePath = $fullPath;
            $fileName = $name ?: $file->getClientOriginalName();
            
            // Create multipart form data
            $response = Http::withHeaders([
                'pinata_api_key' => $this->apiKey,
                'pinata_secret_api_key' => $this->apiSecret,
            ])->attach(
                'file', file_get_contents($filePath), $fileName
            )->post("{$this->baseUrl}/pinning/pinFileToIPFS");
            
            // Clean up temp file
            Storage::disk('local')->delete($path);
            
            if ($response->successful()) {
                $data = $response->json();
                return $data['IpfsHash'];
            } else {
                \Log::error('Pinata upload failed: ' . $response->body());
                return null;
            }
        } catch (\Exception $e) {
            \Log::error('Pinata service error: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Upload JSON metadata to IPFS via Pinata
     *
     * @param array $metadata The metadata to upload
     * @param string $name Name for the metadata file
     * @return string|null IPFS CID (hash) or null on failure
     */
    public function uploadMetadata(array $metadata, $name = 'metadata.json')
    {
        try {
            $response = Http::withHeaders([
                'pinata_api_key' => $this->apiKey,
                'pinata_secret_api_key' => $this->apiSecret,
                'Content-Type' => 'application/json',
            ])->withBody(
                json_encode($metadata), 'application/json'
            )->post("{$this->baseUrl}/pinning/pinJSONToIPFS", [
                'pinataMetadata' => [
                    'name' => $name,
                ],
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                return $data['IpfsHash'];
            } else {
                \Log::error('Pinata metadata upload failed: ' . $response->body());
                return null;
            }
        } catch (\Exception $e) {
            \Log::error('Pinata service error: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Get the IPFS Gateway URL for a hash
     *
     * @param string $hash IPFS hash
     * @return string URL to access the content
     */
    public function getIpfsUrl($hash)
    {
        return "https://gateway.pinata.cloud/ipfs/{$hash}";
    }
}