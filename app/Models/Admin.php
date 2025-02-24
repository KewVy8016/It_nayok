<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $guard = 'admins';

    protected $fillable = [
        'username',
        'password',
        'email',
        'image',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}