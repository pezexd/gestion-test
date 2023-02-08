<?php

namespace App\Models\PsychopedagogicalLogbooks;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class AssistanceMonitors extends Model
{

    use HasFactory, LogsActivity;

    protected $table = "psychopedagogical_logbook_assistance_monitors";

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $fillable = [
        'psychopedagogical_logbook_id',
        'monitor_id'
    ];

    protected $hidden = [
        'psychopedagogical_logbook_id','created_at','updated_at'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function monitor(){
        return $this->belongsTo(User::class);
    }

    public function psychopedagogical_logbook(){
        return $this->belongsTo(PsychopedagogicalLogbook::class);
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
