<?php

namespace App\Models;

use App\Models\Inscriptions\Beneficiary;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Binnacle extends Model
{
    use ImageTrait, LogsActivity,SoftDeletes;

    protected $table = "binnacles";

    protected $fillable = [
        "consecutive",
        "binnacle_id",
        "type",
        "cultural_right_id",
        "lineament_id",
        "activation_mode",
        "goals_met",
        "start_time",
        "final_hour",
        "activity_name",
        "start_activity",
        "activity_development",
        "end_of_activity",
        "observations_activity",
        "place",
        "experiential_objective",
        "explain_goals_met",
        "development_activity_image",
        "evidence_participation_image",
        "activity_date",
        "nac_id",
        "expertise_id",
        "orientation_id",
        "pec_id",
        "pedagogical_id",
        "beneficiaries_capacity",
        "aforo_file",
        // "assistants",
        "created_by",
        'user_review_manager_cultural_id',
        'user_review_support_follow_id',
        'user_review_instructor_leader_id',
        'user_method_support_id',
        'beneficiaries_or_capacity'
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function beneficiaries()
    {
        return $this->belongsToMany(Beneficiary::class);
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
    public function user(){
		return $this->belongsTo(User::class,'created_by','id');
	}
}
