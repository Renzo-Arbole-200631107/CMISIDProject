<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_profile_id',
        'user_id',
        'tech_stack',
    ];

    public function userProfile(){
        return $this->belongsTo(User::class);
    }
}
