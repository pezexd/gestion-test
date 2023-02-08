<?php

namespace App\Models;

use App\Models\PsychosocialInstructions\PsychosocialInstruction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ControlChangeData;

class AssistantPsicosocialInstruction extends Model
{
    use HasFactory;

    protected $table = "assistant_psicosocial_instructions";

    protected $fillable = [
      'psycho_inst_id',
      'assistant_id',

    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function nac(){
        return $this->belongsTo(Nac::class,'nac_id');
    }

    public function psychosocialInstructions(){
        return $this->belongsTo(PsychosocialInstruction::class,'psycho_inst_id');
    }

    protected function assistants()
    {
        return $this->belongsTo(Asistant::class,'assistant_id');
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}

