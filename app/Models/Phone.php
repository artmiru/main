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

    /**
     * Пользователи, принадлежащие к телефону.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
