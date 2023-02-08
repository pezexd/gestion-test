<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PermissionRole extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'permission_roles';

    protected $fillable = [
        'permission_id',
        'role_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
