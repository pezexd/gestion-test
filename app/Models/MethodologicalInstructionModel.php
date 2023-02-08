<?php

namespace App\Models;

use App\Models\Asistant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MethodologicalInstructionModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'methodological_instructions';
    protected $fillable = [
        'place',
        'activity_date',
        'consecutive',
        'start_time',
        'final_hour',
        'expertise_id',
        'nac_id',
        'created_by',
        'goals_met',
        'explanation',
        'pedagogical_comments',
        'technical_practical_comments',
        'methodological_comments',
        'others_observations',
        'place_file1',
        'place_file2',
        'status',
        'reject_message',
        'user_method_support_id'
    ];

    public function assistants()
    {
        return $this->belongsToMany(User::class, 'assistant_methodological_instruction', 'm_i_id', 'assistant_id');
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
