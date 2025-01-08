<?php

namespace App\Models;
use App\Models\Office;
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
        'office_id',
        'user_id',
        'tech_stack',
        'start_sad',
        'start_dev',
        'estimate_deployment',
        'deployment_date',
        'version',
        'status',
        'public_link',
        'admin_link',
        'attachment',
        'dev_remarks',
        'google_remarks',
        'seo_comments',
        'dpa_remarks',
        'remarks',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function attachments(){
        return $this->hasMany(Attachment::class);
    }

    public function office(){
        return $this->belongsTo(Office::class);
    }

    public function projectModules(){
        return $this->hasMany(ProjectModules::class);
    }

    protected static $logFields = [
        'project_id',
        'project_name',
        'description',
        'office_id',
        'user_id',
        'designation',
        'tech_stack',
        'start_sad',
        'start_dev',
        'estimate_deployment',
        'deployment_date',
        'version',
        'status',
        'public_link',
        'admin_link',
        'attachment',
        'dev_remarks',
        'google_remarks',
        'seo_comments',
        'dpa_remarks',
    ];

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->useLogName('project')
            ->dontSubmitEmptyLogs();
    }
}
