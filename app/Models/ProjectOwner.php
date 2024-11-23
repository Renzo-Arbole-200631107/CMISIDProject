<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectOwner extends Model
{
    use HasFactory;
    protected $fillable=[
        'project_owner_id',
        'office_id',
        'focal_person',
        'contact_number',
    ];

    public function owner(){
        return $this->belongsTo(Office::class);
    }

    public function projectFor(){
        return $this->hasMany(Project::class);
    }
}
