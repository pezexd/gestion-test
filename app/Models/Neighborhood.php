<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class Neighborhood extends Model
{
    use SoftDeletes;
    use HasFactory, LogsActivity;

    protected $table = "neighborhoods";

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
	public function user(){
		return $this->belongsTo(User::class);
	}
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
