<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AccessLogin extends Model
{
    use HasFactory, LogsActivity;

    protected $table = "access_logins";

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
