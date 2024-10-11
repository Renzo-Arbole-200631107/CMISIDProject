<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable=[
        'account_id',
        'last_name',
        'first_name',
        'middle_name',
        'username',
        'is_admin',
        'is_active'
    ];
    
};


