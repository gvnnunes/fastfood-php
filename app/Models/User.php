<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public    $timestamps   = true;
    protected $table        = 'users';
    protected $fillable     = ['username', 'password', 'permission'];
    protected $hidden       = ['password', 'remember_token'];
}
