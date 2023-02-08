<?php

namespace App\Models\PsychopedagogicalLogbooks;

use App\Models\Nac;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class PsychopedagogicalLogbook extends Model
{
    use HasFactory, ImageTrait, LogsActivity;
    use SoftDeletes;

    protected $table = "psychopedagogical_logbooks";

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function monitor()
    {
        return $this->belongsTo(User::class, 'monitor_id');
    }

    public function addedWizards()
    {
        return $this->hasMany(AddedWizards::class, 'psychopedagogical_logbook_id', 'id');
    }

    public function assistanceMonitors()
    {
        return $this->hasMany(AssistanceMonitors::class,'psychopedagogical_logbook_id','id');
    }

    public function nac()
    {
        return $this->belongsTo(Nac::class, 'nac_id');
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
