<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    protected function getMkVisits($id)
    {
        return Visit::join('mks', 'visits.mk_id', '=', 'mks.id')
            ->join('mk_pics', 'mks.pic_id', '=', 'mk_pics.id')
            ->join('visit_statuses', 'visits.visit_status_id', '=', 'visit_statuses.id')
            ->select('visits.comments', 'mks.date_time', 'mk_pics.title', 'visit_statuses.title as status')
            ->where('user_id', '=', $id)
            ->orderBy('visits.date_time', 'desc')
            ->get();
    }

    protected function getAbonements($id)
    {
        $abs = Abonement::join('payments', 'payments.id', '=', 'abonements.payment_id')
            ->join('payment_statuses', 'payment_statuses.id', '=', 'payments.payment_status_id')
            ->join('payment_methods', 'payment_methods.id', '=', 'payments.payment_method_id')
            ->join('discounts', 'discounts.id', '=', 'abonements.discount_id')
//            ->join('visits', 'visits.abonement_id', '=', 'abonements.id')
            ->select(
                'abonements.old_id',
                'abonements.id as ab_id',
                'abonements.created_at',
                'abonements.hour',
                'abonements.comments',
                DB::raw("(SELECT SUM(visits.used_hour)
                FROM visits WHERE visits.abonement_id = abonements.id
                AND (visits.visit_status_id = 1 OR visits.visit_status_id = 2)) as sum_used_hours"),
                'discounts.discount',
                'payments.amount',
                'payment_statuses.title as payment_status_title',
                'payment_methods.title as payment_method_title'
            )
            ->where('abonements.user_id', '=', $id)
            ->orderBy('abonements.created_at', 'desc')
            ->get();
        foreach ($abs as $ab) {
            $collection[$ab->ab_id] = $ab;
            $collection[$ab->ab_id]->visits = DB::table('visits')
                ->join('visit_statuses', 'visit_statuses.id', '=', 'visits.visit_status_id')
                ->join('abonements', 'abonements.id', '=', 'visits.abonement_id')
                ->select('visits.used_hour',
                    'visits.hour_used_sum',
                    'visits.date_time',
                    'visits.comments',
                    'visits.visit_status_id',
                    'abonements.hour as hours_amount',
                    'visit_statuses.title as status')
                ->where('visits.abonement_id','=',$ab->ab_id)
                ->orderBy('visits.date_time')
                ->get();
        }
        return $collection;
    }

    protected function coursesVisitsList()
    {
        $vdates = Visit::select('date_time', 'abonement_id')
            ->where('visit_status_id', '=', 1)
            ->where('date_time', '>', now())
            ->where('mk_id', '=', NULL)
            ->groupBy('date_time')
            ->orderBy('date_time')
            ->get();

        foreach ($vdates as $vdate) {
            $collection[$vdate->date_time] = $vdate;
            $collection[$vdate->date_time]->visits = DB::table('visits')
                ->select(
                    'users.family',
                    'users.name',
                    'visits.user_id',
                    'visit_statuses.id as sid',
                    'visit_statuses.title as stitle',
                    'abonements.old_id as ab_old_id',
                    'visits.hour_used_sum',
                    'abonements.hour as all_hours'
                )
                ->join('users', 'users.id', '=', 'visits.user_id')
                ->join('visit_statuses', 'visit_statuses.id', '=', 'visits.visit_status_id')
                ->join('abonements', 'abonements.id', '=', 'visits.abonement_id')
                ->where('visits.date_time', $vdate->date_time)
                ->orderBy('users.family')
                ->orderBy('visits.hour_used_sum')
                ->get();
        }
        return $collection;
    }

}
