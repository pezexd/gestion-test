<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class EntityName extends Model
{
    use SoftDeletes;
    use HasFactory, LogsActivity;

    protected $table = "entity_names";
    protected $fillable = [
        "name",
        "user_id"
    ];
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function getPublishedAtAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function control_data()
    {
        return $this->morphMany(ControlChangeData::class, 'data_model');
    }
}
