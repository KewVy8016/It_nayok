<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "Courses";
    protected $fillable = [
        'course_name', 
        'course_level', 
        'course_year', 
        'course_describe', 
        'branch', 
        'semester', 
        'period', 
        'credit'
    ];
}
