<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    protected $fillable=[
        'office_id',
        'office_name',
        'is_active',
    ];

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
