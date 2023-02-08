<?php

namespace App\Models;

use App\Models\Nac;
use App\Models\ParentSchools\ParentSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Asistant extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "assistants";

    protected $fillable = [
        "assistant_name",
        "assistant_document_number",
        "assistant_position",
        "nac_id",
        "assistant_phone",
        "assistant_email"
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function getPublishedAtAttribute(){
        return $this->created_at->format('d/m/Y');
    }
    public function nac(){
        return $this->belongsTo(Nac::class,'nac_id','id');
    }
    public function dialogueTable(){
        return $this->belongsToMany(DialogueTable::class, 'assistant_dialogue_table', 'assistant_id', 'dialogue_table_id');
    }
    public function methodologicalInstructionModels(){
        return $this->belongsToMany(MethodologicalInstructionModel::class,'assistant_methodological_instruction','assistant_id','m_i_id');
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
