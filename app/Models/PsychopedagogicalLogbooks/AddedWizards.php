<?php

namespace App\Models\PsychopedagogicalLogbooks;

use App\Models\Nac;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ControlChangeData;

class AddedWizards extends Model
{
    use HasFactory, LogsActivity;
    protected $table = "psychopedagogical_logbook_added_wizards";

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $hidden = [
        'created_at','updated_at','psychopedagogical_logbook_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function nac(){
        return $this->belongsTo(Nac::class,'nac_id');
    }

    public function psychopedagogical_logbook(){
        return $this->belongsTo(PsychopedagogicalLogbook::class,'psychopedagogical_logbook_id');
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
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}
}
