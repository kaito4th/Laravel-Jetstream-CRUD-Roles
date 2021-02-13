<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $fillable = [
        'daily_rate',
        'overtime_rate',
        'overtime_pay',
        'sunday_rate',
        'user_id'
    ];
}
