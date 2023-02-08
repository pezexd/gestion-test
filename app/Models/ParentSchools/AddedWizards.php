<?php

namespace App\Models\ParentSchools;

use App\Models\Asistant;
use App\Models\Nac;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class AddedWizards extends Model
{
    use HasFactory, LogsActivity;

    protected $table = "parent_school_added_wizards";

    protected $fillable = [
        "parent_school_id",
        "assistant_id",

    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'parent_school_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function nac()
    {
        return $this->belongsTo(Nac::class, 'nac_id');
    }

    // public function parent_school()
    // {
    //     return $this->belongsTo(ParentSchool::class, 'parent_school_id','id');
    // }
    // protected function assistant()
    // {
    //     return $this->belongsTo(Asistant::class,'assistant_id','id');
    // }


    public function assistant(){
        return $this->belongsTo(Asistant::class);
    }
    protected function assistantName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::upper(strip_tags(trim($value))),
        );
    }

    protected function assistantPosition(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::upper(strip_tags(trim($value))),
        );
    }
    public function control_data()
    {
        return $this->morphMany(ControlChangeData::class, 'data_model');
    }
}
