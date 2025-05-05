<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{


    protected $fillable = [
        'name' , 'description','creator_id','contract_address' , 'royalty_percentage',
    ];

        // Define the relationship to the User model for the creator
        public function creator()
        {
            return $this->belongsTo(User::class, 'creator_id');
        }
    
        // Optionally, define the relationship to NFTs
        public function nfts()
        {
            return $this->hasMany(NFT::class, 'collection_id');
        }
    
}
