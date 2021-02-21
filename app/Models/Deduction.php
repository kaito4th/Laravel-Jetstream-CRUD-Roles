<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'SSS_premium',
        'SSS_loan',
        'philhealth',
        'pagibig',
        'pagibig_loan',
    ];
}
