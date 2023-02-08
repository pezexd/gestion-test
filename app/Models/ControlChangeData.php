<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlChangeData extends Model
{
    use HasFactory;
    protected $table = "data_models";
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'action',
        'data_original',
        'data_change',
    ];

    protected $casts = [
        'data_original' => 'array',
        'data_change' => 'array',
    ];

    public function data_model()
    {
        return $this->morphTo();
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
    public function user(){
		return $this->belongsTo(User::class);
	}
}
