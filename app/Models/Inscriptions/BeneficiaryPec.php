<?php

namespace App\Models\Inscriptions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class BeneficiaryPec extends Model
{
    use HasFactory, LogsActivity;
    protected $table = "beneficiary_pec";

    protected $fillable = [
        'pec_id',
        'beneficiary_id',

    ];

    // protected $with = ['beneficiaries', 'pecs'];
    // public function beneficiaries()
    // {
    //     return $this->belongsTo(Beneficiary::class, 'beneficiary_id', 'id');
    // }
    // public function pecs()
    // {
    //     return $this->belongsTo(Pec::class, 'pec_id', 'id');
    // }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id', 'id');
    }
    public function pec()
    {
        return $this->belongsTo(Pec::class, 'pec_id', 'id');
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}

}
