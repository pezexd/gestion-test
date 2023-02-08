<?php

namespace App\Models;

use App\Models\Inscriptions\Beneficiary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PollDesertion extends Model
{
    use HasFactory, LogsActivity;
    use SoftDeletes;
    protected $table = "polls_desertion";
    protected $fillable = [
        'consecutive',
        'beneficiary_id',
        'date',
        'nac_id',
        'beneficiary_attrition_factors',
        'beneficiary_attrition_factor_other',
        'disinterest_apathy',
        'disinterest_apathy_explanation',
        'reintegration',
        'reintegration_explanation',
        'user_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function nac(){
		return $this->belongsTo(Nac::class);
	}
    public function beneficiary(){
		return $this->belongsTo(Beneficiary::class);
	}
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
    public function user(){
		return $this->belongsTo(User::class);
	}
}
