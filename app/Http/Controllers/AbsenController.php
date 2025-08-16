<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index(){
        return view('absen.index');
    }


    public function super_absen(){
        return view('absen.superadmin-absen');
    }
}
