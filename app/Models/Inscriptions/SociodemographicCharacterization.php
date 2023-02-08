<?php

namespace App\Models\Inscriptions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class SociodemographicCharacterization extends Model
{
    use HasFactory, LogsActivity;
    use SoftDeletes;

    protected $table = "socio_demos";
    protected $fillable = [
        'socio_demo_id', 'socio_demo_type', 'age', 'gender', 'decision_study', 'educational_level', 'decision_disability', 'disability_type', 'ethnicity', 'condition'
    ];
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

    public function socio_demo(){
        return $this->morphTo();
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
