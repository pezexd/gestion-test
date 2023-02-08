<?php

namespace App\Models;

use App\Models\Inscriptions\Beneficiary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = "groups";
    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class,'group_id','id')->select('beneficiaries.id','beneficiaries.full_name','beneficiaries.document_number as nuip');
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
}
