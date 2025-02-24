<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class addtional extends Model
{
    protected $table = "addtionals";
    protected $fillable = [
        "name",
        "url",
        "image",
        "show"
    ];
}
