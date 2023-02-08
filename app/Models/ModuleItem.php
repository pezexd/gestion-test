<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Module;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ModuleItem extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'module_items';

    protected $fillable = [
        'name',
        'description',
        'route',
        'icon',
        'available',
        'module_id',
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

    public function module()
    {
        return $this->belongsTo(Module::class,'module_id','id');
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
