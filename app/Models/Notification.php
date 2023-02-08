<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = "notifications";

    protected $fillable = [
        'sender_id',
        'receptor_id',
        'title',
        'description',
        'read',
        'trash'
    ];

    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    public function receptor()
    {
        return $this->belongsTo(User::class, 'receptor_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
