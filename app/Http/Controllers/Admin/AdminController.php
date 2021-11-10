<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mk;
use App\Models\User;

class AdminController extends Controller
{
//    public function index()
//    {
//        return view('admin.index');
//    }

    public function MkList(){

//$mk = Mk::find(3)->first();
//        dump($mk->user);

        $mks = Mk::getListOfUsersOnMk();
        foreach ($mks as $mk){
            dump($mk->user);
        }
        return view('admin.mk.list',[
            'mks'=>$mks
        ]);
    }
}
