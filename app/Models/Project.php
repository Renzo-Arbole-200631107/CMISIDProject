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
        'project_owner_id',
        'project_manager',
        'tech_stack',
        'estimate_deployment',
        'deployment_date',
        'version',
        'status',

        'public_link',
        'admin_link',

        'sad_files',
        'deployment_files',
        'agreement_files',
        'form_files',

        'google_remarks',
        'seo_comments',
        'dpa_remarks',

        'module_name_1',
        'start_date_1',
        'end_date_1',
        'module_status_1',
        'version_level_1',
        'user_id_1',
        'dev_remarks_1',

        'module_name_2',
        'start_date_2',
        'end_date_2',
        'module_status_2',
        'version_level_2',
        'user_id_2',
        'dev_remarks_2',

        'module_name_3',
        'start_date_3',
        'end_date_3',
        'module_status_3',
        'version_level_3',
        'user_id_3',
        'dev_remarks_3',

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

    public function projectManager(){
        return $this->belongsTo(User::class, 'project_manager');
    }

    public function modules(){
        return $this->hasMany(ProjectModules::class);
    }

    public function owner(){
        return $this->belongsTo(ProjectOwner::class, 'project_owner_id');
    }

    protected static $logFields = [
        'project_id',
        'project_name',
        'description',
        'office_id',
        'user_id',
        'project_owner_id',
        'project_manager',
        'tech_stack',
        'estimate_deployment',
        'deployment_date',
        'version',
        'status',

        'public_link',
        'admin_link',

        'sad_files',
        'deployment_files',
        'agreement_files',
        'form_files',

        'google_remarks',
        'seo_comments',
        'dpa_remarks',

        'module_name_1',
        'start_date_1',
        'end_date_1',
        'module_status_1',
        'version_level_1',
        'user_id_1',
        'dev_remarks_1',

        'module_name_2',
        'start_date_2',
        'end_date_2',
        'module_status_2',
        'version_level_2',
        'user_id_2',
        'dev_remarks_2',

        'module_name_3',
        'start_date_3',
        'end_date_3',
        'module_status_3',
        'version_level_3',
        'user_id_3',
        'dev_remarks_3',
    ];

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->useLogName('project')
            ->dontSubmitEmptyLogs();
    }
}
