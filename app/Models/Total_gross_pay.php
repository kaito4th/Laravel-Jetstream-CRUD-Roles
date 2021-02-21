<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Total_gross_pay extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'total_gross',
        'basic_pay',
        'total_ot_pay',
        'total_sot_pay',
        'total_half_pay',
        'total_spl_pay',
        'allowance',
    ];
}
