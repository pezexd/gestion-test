<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistantMethodologicalInstruction extends Model
{
    use HasFactory;
    protected $table = 'assistant_methodological_instruction';

    protected $fillable = [
        'm_i_id',
        'assistant_id',
    ];
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
