<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phones';
    protected $fillable = [
        'phone',
    ];
    public $timestamps = false;

    /**
     * Пользователи, принадлежащие к телефону.
     */
    public function user()
    {
        return $this->belongsToMany(User::class,'phone_user','phone_id','user_id');

    }
}
