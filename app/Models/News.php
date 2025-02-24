<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'describe',
        'category',
        'image_path',
        'created_by',
        'created_time',
    ];
}
