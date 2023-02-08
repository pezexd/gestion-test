<?php

namespace App\Models\Inscriptions;

use App\Models\Nac;
use App\Models\Neighborhood;
use App\Models\ControlChangeData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImageTrait;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Pec extends Model
{
    use HasFactory, SoftDeletes, ImageTrait, LogsActivity;
    protected $table = "pecs";
    protected $fillable = [
        'nac_id',
        'user_id',
        'consecutive',
        'neighborhood_id',
        'place',
        'place_address',
        'activity_date',
        'start_time',
        'final_hour',
        'place_type',
        'place_description',
        'place_image1',
        'place_image2',
        'user_review_manager_cultural_id',
        'user_review_instructor_leader_id',
    ];

    public function getPublishedAtAttribute(){
        return $this->created_at->format('d/m/Y');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function nac()
    {
        return $this->belongsTo(Nac::class, 'nac_id', 'id');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id', 'id');
    }
    public function pecsBeneficiaries()
    {
        return $this->belongsToMany(Beneficiary::class)->select('beneficiaries.id','full_name','document_number as nuip');
    }
    public function get_activity_date(){
        return Carbon::parse($this->activity_date)->format('d/m/Y');
    }
//   public function beneficiarypecs()
//   {
//       return $this->hasMany(BeneficiaryPec::class,'pec_id','id');
//   }
    /*Relación polimorfica */
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}

}
