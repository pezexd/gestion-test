<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupBeneficiary extends Model
{
    use HasFactory;
    protected $table = "group_beneficiaries";
    protected $fillable = [
        'group_id',
        'beneficiary_id',

    ];
}
