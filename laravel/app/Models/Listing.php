<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
        // Define the fillable attributes for mass assignment
        protected $fillable = [
            'nft_id',          // The NFT being listed
            'seller_id',       // The user selling the NFT
            'price',           // The price of the NFT listing
            'currency',        // The currency (e.g., ETH, USD)
            'status',          // The status of the listing (active, sold, cancelled)
            'expiration',      // The expiration date of the listing (nullable)
        ];
    
        // Optional
        public function nft()
        {
            return $this->belongsTo(NFT::class, 'nft_id');
        }
    
        public function seller()
        {
            return $this->belongsTo(User::class, 'seller_id');
        }
    
}
