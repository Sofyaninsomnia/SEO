<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran_kas;
use Illuminate\Http\Request;

class PengeluaranKasController extends Controller
{
    public function index (){
        $dataKas = Pengeluaran_kas::all();
        return view('superadmin.kas_keluar', compact('dataKas'));
    }
}
