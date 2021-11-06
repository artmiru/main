<?php

namespace App\Http\Controllers;

use App\Models\Mk;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class MkController extends Controller
{
    public function index(){
        $mks = Mk::join('mk_pics', 'mks.pic_id', '=', 'mk_pics.id')
            ->join('teachers', 'mks.teacher_id', '=', 'teachers.id')
            ->join('prices', 'mks.price_id', '=', 'prices.id')
            ->orderBy('mks.date_time')
            ->get(['mks.date_time','mks.status', 'mk_pics.src','mk_pics.title','teachers.name','teachers.folder','prices.price']);

        if(Mk::where('date_time','>=',now())->count() < 28){
            Mk::generateMkDates();
        }

//        $phone = Phone::find(3);
//        dump($phone->users); // вернет все продукты для категории 1
//        $user = User::find(3);
         // вернет все категории для продукта 1

        return view('mk.page',[
            'mks'=>$mks,
        ]);
    }

}
