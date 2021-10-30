<?php

namespace App\Http\Controllers;

use App\Models\Mk;
use Illuminate\Http\Request;

class MkController extends Controller
{
    public function index(){
        $mks = Mk::join('mk_pics', 'mks.pic_id', '=', 'mk_pics.id')
            ->join('teachers', 'mks.teacher_id', '=', 'teachers.id')
            ->join('prices', 'mks.price_id', '=', 'prices.id')
            ->get(['mks.date_time','mks.status', 'mk_pics.src','mk_pics.title','teachers.name','teachers.folder','prices.price']);
//dd($mks);
        return view('mk.sections.list',[
            'mks'=>$mks,
        ]);
    }
}
