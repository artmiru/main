<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $table='prices';
    protected $guarded=[];
    public function mk() {
        return $this->HasMany(Mk::class);
    }
}
