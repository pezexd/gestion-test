<?php

namespace App\Models\PsychosocialInstructions;

use App\Models\User;
use App\Models\Asistant;
use App\Models\Nac;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class PsychosocialInstruction extends Model
{
    use HasFactory, ImageTrait, LogsActivity;
    use SoftDeletes;

    protected $table = "psychosocial_instructions";

    protected $fillable = [
        'consecutive',
        'activity_date',
        'start_time',
        'final_hour',
        'nac_id',
        'objective_day',
        'themes_day',
        'evidence_participation_image',
        'development_activity_image',
        'user_id',
        'user_psychoso_coordinator_id'
    ];

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

    public function nac()
    {
        return $this->belongsTo(Nac::class, 'nac_id');
    }

    public function assistants()
    {
        return $this->belongsToMany(Asistant::class,'assistant_psicosocial_instructions','psycho_inst_id','assistant_id');
    }
    public function assistanceMonitors()
    {
        return $this->belongsToMany(User::class, 'monitor_psicosocial_instructions', 'psycho_inst_id', 'monitor_id');
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
