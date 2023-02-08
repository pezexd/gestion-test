<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class Profile extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'profiles';


    protected $fillable = [
        'contractor_full_name',
        'document_number',
        'user_id',
        'nac_id',
        'role_id',
        'psychosocial_id',
        'gestor_id',
        'methodological_support_id',
        'support_tracing_monitoring_id',
        'ambassador_leader_id',
        'instructor_leader_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    /**
     * Relationship one to one
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Relationship one to one
     */
    public function gestor()
    {
        return $this->belongsTo(User::class, 'gestor_id', 'id');
    }
    /**
     * Relationship one to one
     */
    public function psychosocial()
    {
        return $this->belongsTo(User::class, 'psychosocial_id', 'id');
    }
    /**
     * Relationship one to one
     */
    public function methodological_support()
    {
        return $this->belongsTo(User::class, 'methodological_support_id', 'id');
    }
    /**
     * Relationship one to one
     */
    public function support_tracing_monitoring()
    {
        return $this->belongsTo(User::class, 'support_tracing_monitoring_id', 'id');
    }
    /**
     * Relationship one to one
     */
    public function ambassador_leader()
    {
        return $this->belongsTo(User::class, 'ambassador_leader_id', 'id');
    }
        /**
     * Relationship one to one
     */
    public function instructor_leader()
    {
        return $this->belongsTo(User::class, 'instructor_leader_id', 'id');
    }
    /**
     * Relationship one to one
     */

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function control_data()
    {
        return $this->morphMany(ControlChangeData::class, 'data_model');
    }
    public function nac()
    {
        return $this->belongsTo(Nac::class, 'nac_id', 'id');
    }
}
