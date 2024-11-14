<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProjectUsers extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable=[
        'project_user_id',
        'project_module_id',
    ];

    public function projectUsers(){
        return $this->belongsTo(ProjectModules::class);
    }

    protected static $logFields = [
        'project_user_id',
        'project_module_id',
    ];

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->useLogName('project')
            ->dontSubmitEmptyLogs();
    }
}
