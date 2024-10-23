<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Project extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable=[
        'project_id',
        'project_name',
        'description',
        'project_owner',
        'account_id',
        'designation',
        'start_sad',
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

    public function account(){
        return $this->belongsTo(Account::class, 'account_id');

    }

    protected static $logFields = [
        'project_id',
        'project_name',
        'description',
        'project_owner',
        'account_id',
        'designation',
        'start_sad',
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

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->useLogName('project')
            ->logAll()
            ->setDescriptionForEvent(fn(string $event) => "Project has been {$event}");
    }
}
