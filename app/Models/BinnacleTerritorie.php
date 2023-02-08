<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class BinnacleTerritorie extends Model
{
    use ImageTrait, LogsActivity, SoftDeletes;

    protected $table = "binnacle_territories";

    protected $fillable = [
        'consecutive',
        'nac_id',
        'role_id',
        'user_id',
        'activity_date',
        'start_time',
        'final_hour',
        'place',
        'strategic_objectives_area',
        'purpose_visit',
        'topics_covered',
        'participants_perception',
        'problems_identified',
        'recommendations_actions',
        'comments_analysis',
        'development_activity_image',
        'evidence_participation_image',
        'reviewed_by',
        'created_by',
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}

    public function user(){
		return $this->belongsTo(User::class,'user_id','id');
	}

    public function created_user(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'binnacle_territories', 'id', 'role_id');
    }

    public function nac(){
        return $this->belongsTo(Nac::class, 'nac_id', 'id');
    }

}
