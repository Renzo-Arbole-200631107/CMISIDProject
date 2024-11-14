<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class ProjectSubItems extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable=[
        'project_sub_items_id',
        'project_module_id',
        'developer_remarks',
    ];

    public function projectSubitems(){
        return $this->belongsTo(ProjectModules::class);
    }

    protected static $logFields = [
        'project_sub_items_id',
        'project_module_id',
        'developer_remarks',
    ];

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->useLogName('project')
            ->dontSubmitEmptyLogs();
    }
}
