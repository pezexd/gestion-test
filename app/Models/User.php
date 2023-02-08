<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Inscriptions\Inscription;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\UserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UserTrait,ImageTrait,SoftDeletes, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'document_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    /**
     * Relationship many to many
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Relationship one to one
     */
    public function profile()
    {
        return $this->hasOne(Profile::class,'user_id','id');
    }
   /**
     * Relationship one to many
     */
    public function inscriptions(){
        return $this->hasMany(Inscription::class,'user_id','id');
    }
    public function notifications_received(){
        return $this->hasMany(Notification::class, 'receptor', 'id');
    }
    public function notifications_sended(){
        return $this->hasMany(Notification::class, 'sender', 'id');
    }
   /**
     * Relationship morp
     */
    public function user_review_form(){
		return $this->morphMany(UserReviewForm::class,'user_review_form');
	}
    public function getPublishedAtAttribute(){
        return $this->created_at->format('d/m/Y');
    }
    public function control_data(){
		return $this->morphMany(ControlChangeData::class,'data_model');
	}

    public function loginaccess()
    {
        return $this->hasMany(AccessLogin::class, 'user_id', 'id');
    }
}
