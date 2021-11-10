<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MkPic extends Model
{
    use HasFactory;
    protected $table = 'mk_pics';
    protected $fillable = [
        'src',
        'title',
        'status'
    ];

    public function mk() {
        return $this->HasMany(Mk::class);
    }

}
