<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Passwords\CanResetPassword;
class SuperAdmin  extends Authenticatable
{
    use HasFactory;
    use HasApiTokens, HasFactory, Notifiable,CanResetPassword;
    protected  $table = 'admin';
    protected $fillable = [
        'id',
        'name',
        'email',
        'mobile',
        'password',
        'created_at',
        'updated_at'
    ];
}
