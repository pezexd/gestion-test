<?php

namespace App\Models;

use App\Models\Inscriptions\Beneficiary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Nac extends Model
{
    use SoftDeletes;
    use HasFactory, LogsActivity;

    protected $table = "nacs";

    protected $guarded = [
        'created_at', 'updated_at'
    ];
    protected $hidden = [
        'user_id','created_at', 'updated_at','deleted_at'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function getPublishedAtAttribute(){
        return $this->created_at->format('d/m/Y');
    }
	public function user(){
		return $this->belongsTo(User::class);
	}
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
    public function beneficiaries(){
		return $this->hasMany(Beneficiary::class)->select('id','full_name','document_number');
	}
}
