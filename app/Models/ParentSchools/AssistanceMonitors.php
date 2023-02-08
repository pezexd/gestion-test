<?php

namespace App\Models\ParentSchools;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AssistanceMonitors extends Model
{
    use HasFactory,LogsActivity;

    protected $table = "parent_school_assistance_monitors";

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $fillable = [
        'parent_school_id',
        'monitor_id'
    ];

    protected $hidden = [
        'parent_school_id','created_at','updated_at'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function monitor(){
        return $this->belongsTo(User::class);
    }

    public function parent_school(){
        return $this->belongsTo(ParentSchool::class);
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
