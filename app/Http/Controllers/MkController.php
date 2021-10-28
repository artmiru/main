<?php

namespace App\Http\Controllers;

use App\Models\Mk;
use Illuminate\Http\Request;

class MkController extends Controller
{
    public function index(){
        $mks = Mk::join('mk_pics', 'mks.id_pic', '=', 'mk_pics.id')
            ->get(['mks.*', 'mk_pics.*']);


        return view('mk.list',[
            'mks'=>$mks,
        ]);
    }
}
