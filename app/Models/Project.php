<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable=[
        'project_id',
        'project_name',
        'description',
        'project_owner',
        'developer_name',
        'designation',
        'estimate_deployment',
        'deployment_date',
        'version',
        'status',
        'link',
        'attachment',
        'dev_remarks',
        'google_remarks',
        'seo_comments',
        'dpa_remarks',
        'remarks',
    ];
}
