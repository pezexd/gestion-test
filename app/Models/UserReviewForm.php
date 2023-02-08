<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReviewForm extends Model
{
    use HasFactory;
    protected $table = 'user_review_forms';

    protected $fillable = [
        'user_id','user_review_form_id','user_review_form_type'
    ];
    public function user_review_form(){
        return $this->morphTo();
    }
}
