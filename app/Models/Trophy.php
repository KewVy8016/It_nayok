<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trophy extends Model
{
    protected $table = "trophy";
    public $timestamps = false;
    protected $fillable = [
        'image', 
        'trophy_name', 
        'trophy_detail', 
        'trophy_type', 
        'trophy_level', 
        'placename', 
        'date', 
        'teacher_name', 
        'student_name'
    ];
}
