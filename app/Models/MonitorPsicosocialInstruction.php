<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitorPsicosocialInstruction extends Model
{
    use HasFactory;

    protected $table = "monitor_psicosocial_instructions";

    protected $fillable = [
      'psycho_inst_id',
      'monitor_id',
    ];
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
