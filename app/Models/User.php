<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'family',
        'patronymic',
        'username',
        'blist',
        'cookie_id',
        'comments',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Роли, принадлежащие пользователю.
     */
    public function phone()
    {
        return $this->belongsToMany(Phone::class,'phone_user','user_id','phone_id');
    }
    public function mk()
    {
        return $this->belongsToMany(Mk::class,'mk_user','user_id','mk_id');
    }
    public function getFullNameAttribute()
    {
        return $this->name . " " . $this->family;
    }
}
