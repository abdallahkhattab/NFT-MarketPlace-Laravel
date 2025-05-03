<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingRegistration extends Model
{


    protected $fillable =[
        'wallet_address','nonce','wallet_type','nonce_generated_at'
    ]
}
