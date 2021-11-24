<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mk extends Model
{
    use HasFactory;

//    protected $table = ['mks'];
    protected $dates = ['date_time'];
    protected $guarded = [];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function mkpic()
    {
        return $this->belongsTo(MkPic::class, 'pic_id');
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function phone()
    {
        return $this->hasManyThrough(Phone::class, User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'visits', 'mk_id', 'user_id');
    }

    public function statuses()
    {
        return $this->belongsToMany(VisitStatus::class, 'visits', 'user_id', 'visit_status_id');
    }

    protected function getAllMks()
    {
        return $this->with('mkpic', 'teacher', 'price')
            ->where('date_time', '>', date('Y-m-d H:i:s'))
            ->orderBy('date_time')
            ->take(24)
            ->get();
    }

    protected function getListOfUsersOnMk()
    {
        $mks = DB::table('mks')
            ->leftjoin('mk_pics', 'mks.pic_id', '=', 'mk_pics.id')
            ->leftJoin('teachers', 'mks.teacher_id', '=', 'teachers.id')
            ->select('mks.id', 'mks.date_time', 'mk_pics.title', 'teachers.name')
            ->where('mks.date_time', '>=', now())
            ->orderBy('mks.date_time')
            ->get();
        foreach ($mks as $mk) {
            $collection[$mk->id] = $mk;
            $collection[$mk->id]->visits = DB::table('visits')
                ->leftJoin('visit_statuses', 'visits.visit_status_id', '=', 'visit_statuses.id')
                ->leftJoin('users', 'visits.user_id', '=', 'users.id')
                ->select('visits.comments','visits.user_id','users.name','users.family','users.patronymic','users.phone', 'visit_statuses.id as stid','visit_statuses.title as stitle')
                ->where('visits.mk_id', '=', $mk->id)
                ->where('visit_statuses.id','!=','4')
                ->get();
        }
        return $collection;
    }

//Находит все даты вперед на месяц, проверяет каждую дату, какой день недели,
//если день подходит то вносит в базу дату время фото препода и стоимость.
//fistorcreate проверяет есть ли запись в базе по дате и если нет то вносит.
//если записей меньше 28 тогда выполняется.

    protected function generateMkDates()
    {
        if (Mk::where('date_time', '>=', now())->count() < 25) {

            $period = CarbonPeriod::create(Carbon::now(), Carbon::now()->addMonth());
            foreach ($period as $date) {

                $d12 = date('Y-m-d 12:00:00', strtotime($date));
                $d17 = date('Y-m-d 17:00:00', strtotime($date));
                $d11 = date('Y-m-d 11:00:00', strtotime($date));
                $d19 = date('Y-m-d 19:00:00', strtotime($date));
                switch ($date->dayOfWeek) {
                    case 0:
                        Mk::firstOrCreate(
                            [
                                'date_time' => $d12
                            ],
                            [
                                'teacher_id' => 3,
                                'pic_id' => $this->genPicForMk(),
                                'price_id' => 11
                            ]
                        );
                        Mk::firstOrCreate(
                            [
                                'date_time' => $d17
                            ],
                            [
                                'teacher_id' => 3,
                                'pic_id' => $this->genPicForMk(),
                                'price_id' => 11
                            ]
                        );
                        break;
                    case 1:
                        Mk::firstOrCreate(
                            [
                                'date_time' => $d11
                            ],
                            [
                                'teacher_id' => 3,
                                'pic_id' => $this->genPicForMk(),
                                'price_id' => 10
                            ]
                        );
                        break;
                    case 3:
                        Mk::firstOrCreate(
                            [
                                'date_time' => $d11
                            ],
                            [
                                'teacher_id' => 3,
                                'pic_id' => $this->genPicForMk(),
                                'price_id' => 10
                            ]
                        );
                        break;
                    case 5:
                        Mk::firstOrCreate(
                            [
                                'date_time' => $d11
                            ],
                            [
                                'teacher_id' => 3,
                                'pic_id' => $this->genPicForMk(),
                                'price_id' => 10
                            ]
                        );
                        break;
                    case 6:
                        Mk::firstOrCreate(
                            [
                                'date_time' => $d19
                            ],
                            [
                                'teacher_id' => 3,
                                'pic_id' => $this->genPicForMk(),
                                'price_id' => 11
                            ]
                        );
                        break;
                }

            }
        }

    }

    protected function genPicForMk()
    {
        $pics = Mkpic::where('status', 1)->get('id')->toArray();
        $pics_in_use = Mk::where('date_time', '>=', now())->get('pic_id')->toArray();
        //выбирает все pics которых нет в pics in use, и эти фото показывает из pics
        $diff = array_diff(array_map('serialize', $pics), array_map('serialize', $pics_in_use));
        $pics_ok = array_map("unserialize", $diff);
        //выбирает случайный кей и сразу выводит id фото
        return $pics_ok[array_rand($pics_ok)]['id'];
    }
}
