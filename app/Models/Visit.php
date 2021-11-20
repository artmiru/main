<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'visits';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mk()
    {
        return $this->belongsTo(Mk::class);
    }

    public function status()
    {
        return $this->belongsTo(VisitStatus::class);
    }

    public function visits($id)
    {
        return Visit::join('mks','visits.mk_id','=','mks.id')
            ->join('mk_pics','mks.pic_id','=','mk_pics.id')
            ->join('visit_statuses','visits.visit_status_id','=','visit_statuses.id')
            ->select('visits.comments','mks.date_time','mk_pics.title','visit_statuses.title as status')
            ->where('user_id','=',$id)
            ->orderBy('visits.date_time','desc')
            ->get();
    }

}
