<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable=[
        'last_name',
        'first_name',
        'middle_name',
        'username',
        'role_description',
        'is_active'
    ];
}
