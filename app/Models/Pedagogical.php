<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Pedagogical extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
    protected $table = "pedagogicals";

	protected $fillable = [
        'consecutive',
        'monitor_id',
        'activity_name',
        'activity_date',
        'cultural_right_id',
        'nac_id',
        'expertise_id',
        'experiential_objective',
        'lineament_id',
        'orientation_id',
        'manifestation',
        'process',
        'product',
        'resources',
        'status',
        'user_review_manager_cultural_id',
        'user_review_instructor_leader_id',
        'created_by'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function getPublishedAtAttribute(){

        return is_null($this->created_at) ?'':$this->created_at->format('d/m/Y') ?? '';
    }

    public function get_activity_date(){
        return Carbon::parse($this->activity_date)->format('d/m/Y');
    }
    // public function monitor(){
	// 	return $this->belongsTo(User::class,'monitor_id','id');
	// }
	public function user(){
		return $this->belongsTo(User::class,'created_by','id');
	}
    public function cultural_right(){
    return $this->belongsTo(CulturalRight::class,'cultural_right_id','id');
	}
    public function nac(){
		return $this->belongsTo(Nac::class,'nac_id','id');
	}
    public function expertise(){
		return $this->belongsTo(Expertise::class,'expertise_id','id');
	}
    public function orientation(){
		return $this->belongsTo(Orientation::class,'orientation_id','id');
	}
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}

}
