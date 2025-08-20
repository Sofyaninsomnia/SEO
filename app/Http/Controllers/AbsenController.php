<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function user_absen(){
        return view('absen.user');
    }


    public function super_absen(){
        return view('absen.superadmin-absen');
    }
}
