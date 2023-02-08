<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Role extends Model
{
    use HasFactory, LogsActivity;
    use SoftDeletes;

    protected $table = 'roles';

    protected $with = ['permissions'];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'full-access',
        'public'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_roles', 'role_id', 'permission_id');
    }
    public function permission_menus()
    {
        return $this->belongsToMany(Permission::class, 'permission_roles', 'role_id', 'permission_id')->where('slug', 'LIKE', '%.index%')->select('slug');
    }
    /**
     * Relationship many to many
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function BinnacleTerritorie(){
        return $this->belongsTo(BinnacleTerritorie::class);
    }

    /**
     * Relationship one to one
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
