<?php

namespace App\Models\Inscriptions;

use App\Models\Neighborhood;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImageTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;
use App\Models\User;

class Attendant extends Model
{
    use HasFactory,ImageTrait,LogsActivity;
    use SoftDeletes;

    protected $table = "attendants";

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function getPublishedAtAttribute(){
        return $this->created_at->format('d/m/Y');
    }
	// public function user(){
	// 	return $this->belongsTo(User::class);
	// }
    public function health_data(){
		return $this->morphOne(HealthData::class,'health_data');
	}
    public function socio_demo(){
		return $this->morphOne(SociodemographicCharacterization::class,'socio_demo');
	}

    public function neighborhood(){
        return $this->hasOne(Neighborhood::class, 'id','neighborhood_id');
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id');
    }

}
