<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mk;
use App\Models\User;
use App\Models\Visit;
use App\Models\VisitStatus;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
//    public function index()
//    {
//        return view('admin.index');
//    }

    public function profile()
    {

    }

    public function MkList()
    {
//        $this->updateVisitTable();
        $visit_statuses = VisitStatus::all();
        return view('admin.mk.list', [
            'mks' => Mk::getListOfUsersOnMk(),
            'visit_statuses' => $visit_statuses
        ]);
    }

    public function updateVisitTable()
    {

        DB::table('mks')->where('date_time','!=','000-00-00 00:00:00')
            ->lazyById()->each(function ($mk) {
//                echo $mk->date_time.' - '.$mk->id.'<br>';
                DB::table('visits')
                    ->where('date_time', $mk->date_time)
                    ->update(['mk_id' => $mk->id]);
            });
    }

    public function updateMksTable()
    {
        $mks = DB::table('mk_records')
            ->join('teachers', 'mk_records.rec_teacher', '=', 'teachers.folder')
            ->join('prices', 'mk_records.rec_price', '=', 'prices.price')
            ->join('mk_pics', 'mk_records.rec_img', '=', 'mk_pics.src')
            ->select('mk_records.*', 'teachers.id as tid', 'prices.id as pid', 'mk_pics.id as mkpid')
            ->orderBy('mk_records.rec_date_time')
            ->get();

        foreach ($mks as $mk) {
            Mk::firstOrCreate([
                'date_time' => $mk->rec_date_time
            ],[
                'pic_id' => $mk->mkpid,
                'teacher_id' => $mk->tid,
                'price_id' => $mk->pid,
                'sms' => $mk->rec_sms,
                'status' => $mk->rec_state,
                'created_at' => $mk->rec_date_time
            ]);
        }
    }

    public function generateUniqueCode()
    {
        do {
            $code = random_int(10000, 99999);
        } while (User::where("username", "=", $code)->first());

        return $code;
    }
}
