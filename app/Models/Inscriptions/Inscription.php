<?php

namespace App\Models\Inscriptions;

use App\Models\User;

use App\Models\Inscriptions\Beneficiary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class Inscription extends Model
{
    use HasFactory, LogsActivity;
    use SoftDeletes;

    protected $table = "inscriptions";

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $hidden = [
        'beneficiary_id','user_id'
    ];
    public function getPublishedAtAttribute(){
        return $this->created_at->format('d/m/Y');
    }
    // public function health_data(){
	// 	return $this->belongsTo(HealthData::class,'health_data_id','id');
	// }
    // public function sociodemographic_characterization(){
	// 	return $this->belongsTo(SociodemographicCharacterization::class,'sociodemographic_characterization_id','id');
	// }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function benefiary(){
		return $this->belongsTo(Beneficiary::class,'beneficiary_id','id');
	}
    public function user(){
		return $this->belongsTo(User::class,'created_by','id');
	}
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
