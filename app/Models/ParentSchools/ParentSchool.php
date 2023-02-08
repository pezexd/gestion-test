<?php

namespace App\Models\ParentSchools;

use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class ParentSchool extends Model
{
    use HasFactory, ImageTrait, LogsActivity;
    use SoftDeletes;

    protected $table = "parent_schools";

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $hidden = [
        'deleted_at',
    ];

    protected $casts = [
        // 'start_time' => 'datetime:g:i A',
        // 'final_time' => 'datetime:g:i A',
        'date' => "datetime:Y-m-d",

    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function monitor()
    {
        return $this->belongsTo(User::class, 'monitor_id');
    }

    // public function addedWizards()
    // {
    //     return $this->belongsTo(AddedWizards::class,'parent_school_added_wizards', 'assistant_id','parent_school_id');
    // }

    public function addedWizards()
    {
        return $this->hasMany(AddedWizards::class, 'parent_school_id', 'id');
    }
    // 'parent_school_added_wizards',
    // public function assistants()
    // {
    //     return $this->belongsToMany(User::class, 'assistant_methodological_instruction', 'm_i_id', 'assistant_id');
    // }

    public function assistanceMonitors()
    {
        return $this->hasMany(AssistanceMonitors::class, 'parent_school_id', 'id');
    }
    public function control_data()
    {
        return $this->morphMany(ControlChangeData::class, 'data_model');
    }
}
