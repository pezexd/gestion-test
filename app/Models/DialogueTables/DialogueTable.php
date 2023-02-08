<?php

namespace App\Models\DialogueTables;

use App\Models\Nac;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asistant;
use App\Models\ControlChangeData;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class DialogueTable extends Model
{
    use SoftDeletes;
    protected $table = "dialogue_tables";
    protected $fillable = [
        "activity_date",
        "start_time",
        "final_hour",
        "consecutive",
        "nac_id",
        "target_workday",
        "theme",
        "schedule_day",
        "workday_description",
        "achievements_difficulties",
        "alerts",
        "place_image1",
        "place_image2",
        'status',
        'reject_message',
        'user_id',
        'user_method_support_id'
    ];
    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function getPublishedAtAttribute(){
        return $this->created_at->format('d/m/Y');
    }

    public function assistant(){
        return $this->belongsToMany(Asistant::class, 'assistant_dialogue_table', 'dialogue_table_id', 'assistant_id');
    }

    public function nac(){
        return $this->belongsTo(Nac::class);
    }

    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}

    public function user(){
		return $this->belongsTo(User::class);
	}

    public function manager(){
		return $this->belongsTo(User::class,'user_review_manager_cultural_id','id');
	}

    public function method_support(){
		return $this->belongsTo(User::class,'user_method_support_id','id');
	}
}
