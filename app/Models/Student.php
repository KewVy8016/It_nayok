<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'education_level',
        'male_count',
        'female_count',
    ];
}
