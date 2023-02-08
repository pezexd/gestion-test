<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class Permission extends Model
{
    use HasFactory, LogsActivity;
    use SoftDeletes;
    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'controller'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'permission_roles', 'permission_id', 'role_id');
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
