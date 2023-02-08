<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class Module extends Model
{
    use HasFactory,SoftDeletes, LogsActivity;

    protected $table = 'modules';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'available',
        'hasItems',
        'position'
    ];
    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function items()
    {
        return $this->hasMany(ModuleItem::class);
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
