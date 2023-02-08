<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class MonthlyMonitoringReports extends Model
{
    use ImageTrait, LogsActivity, SoftDeletes;

    protected $table = "monthly_monitoring_reports";

    protected $fillable = [
        'consecutive',
        'date',
        'file',
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
