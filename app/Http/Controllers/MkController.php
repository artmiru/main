<?php

namespace App\Http\Controllers;

use App\Models\Mk;
use Illuminate\Http\Request;

class MkController extends Controller
{
    public function index(){

//        Mk::generateMkDates();
        return view('mk.page',[
            'mks'=>Mk::getAllMks()
        ]);
    }

}
