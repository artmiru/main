<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MkController extends Controller
{
    public function index(){
        return view('mk.list');
    }
}
