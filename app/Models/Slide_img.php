<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide_img extends Model
{
    protected $table = "slide_img";
    protected $fillable = [
        "image",
        "title"
    ];
}
