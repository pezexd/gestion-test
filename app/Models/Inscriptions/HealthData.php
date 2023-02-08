<?php

namespace App\Models\Inscriptions;

use App\Models\EntityName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class HealthData extends Model
{
    use HasFactory, LogsActivity;
    use SoftDeletes;

    protected $table = "health_datas";
    protected $fillable =['entity_name_id', 'other_entity_name', 'health_data_id','health_data_type','medical_service','health_condition'];

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
    public function health_data(){
        return $this->morphTo();
    }
    public function entity_name()
    {
        return $this->hasOne(EntityName::class, 'id','entity_name_id');
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
