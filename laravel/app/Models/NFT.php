<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NFT extends Model
{
        // Specify which fields are mass-assignable
        protected $fillable = [
            'token_id',
            'collection_id',
            'name',
            'description',
            'media_url',
            'metadata_url',
            'creator_id',
            'owner_id',
        ];
    
        // Optionally, you can define relationships here
        public function collection()
        {
            return $this->belongsTo(Collection::class);
        }
    
        public function creator()
        {
            return $this->belongsTo(User::class, 'creator_id');
        }
    
        public function owner()
        {
            return $this->belongsTo(User::class, 'owner_id');
        }
    
}
