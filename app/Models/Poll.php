<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Poll extends Model
{
    use HasFactory, LogsActivity;
    use SoftDeletes;

    protected $table = "polls";
    protected $guarded = [
        'created_at', 'updated_at'
    ];
    protected $fillable = [
        'gender',
        'age',
        'birth_date',
        'marital_state',
        'stratum',
        'neighborhood_id',
        'other_neighborhoods',
        'phone',
        'email',
        'number_children',
        'dependents',
        'relationship_head_household',
        'ethnicity',
        'victim_armed_conflict',
        'single_registry_victims',
        'study',
        'educational_level',
        'medical_services',
        'entity_name_id',
        'other_entity_name',
        'health_condition',
        'takes_medication',
        'suffers_disease',
        'type_disease',
        'other_disease_type',
        'disability',
        'disability_type',
        'assessed_disability',
        'receives_therapy',
        'expertises',
        'artistic_experience',
        'artistic_group',
        'artistic_group_name',
        'role_artistic_group',
        'user_id',
        'other_disability_type'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
    public function getPublishedAtAttribute(){
        return $this->created_at->format('d/m/Y');
    }
    public function neighborhood(){
		return $this->belongsTo(Neighborhood::class);
	}
    public function entity_name(){
		return $this->belongsTo(EntityName::class);
	}
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
    public function user(){
		return $this->belongsTo(User::class);
	}
}
