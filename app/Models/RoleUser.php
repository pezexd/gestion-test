<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RoleUser extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'role_user';

    protected $fillable = [
        'role_id',
        'user_id'
    ];

    protected $with = ['roles', 'users'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
