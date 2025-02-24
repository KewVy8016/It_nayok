<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studyplan extends Model
{
    protected $table = 'studyplans';

    protected $fillable = [
        'name', 
        'year', 
        'pathfile'
    ];
}
