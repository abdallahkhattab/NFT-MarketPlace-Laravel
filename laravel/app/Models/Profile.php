<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = [
        'user_id','bio','avatar','background_image','personal_website',
        'twitter','instagram'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

  
    public function avatarUrl()
    {
        if($this->avatar){
            return asset('storage/' . $this->avatar);
        } else {
        return 'https://ui-avatars.com/api/?name=' . $this->user->name;
        }
    }

    public function backgroundUrl()
    {
        if($this->background_image)
        {
            return asset('storage/' . $this->background_image);
        }else{
            return 'https://ui-avatars.com/api/?name=' . $this->user->name;
        }
    }
}
