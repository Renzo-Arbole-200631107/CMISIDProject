<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProjectModules extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable=[
        'project_module_id',
        'project_id',
        'module_name',
        'version_level',
        'start_date',
        'end_date',
        'module_status',
    ];

    public function projectModule(){
        return $this->belongsTo(Project::class);
    }

    public function projectUsers(){
        return $this->hasMany(ProjectUsers::class);
    }

    public function projectSubitems(){
        return $this->hasMany(ProjectSubItems::class);
    }

    protected static $logFields = [
        'project_module_id',
        'project_id',
        'module_name',
        'version_level',
        'start_date',
        'end_date',
        'module_status',
    ];

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->useLogName('project')
            ->dontSubmitEmptyLogs();
    }
}
