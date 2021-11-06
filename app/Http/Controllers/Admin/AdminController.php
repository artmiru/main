<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mk;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function MkList(){

        $mks = Mk::all();
        return view('admin.mk.list',['mks'=>$mks]);
    }
}
