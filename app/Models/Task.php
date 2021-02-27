<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'start',
        'end'
    ];

    public function setDate($value){
        $this->attributes['start'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
        $this->attributes['end'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }
    
}
