<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Tgl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\User;

class KasController extends Controller
{
    public function superKas()
    {
        $data = Tgl::all();
        return view('superadmin.kas', compact('data'));
    }

    public function add_tgl(Request $request)
    { 
        $rules = [
            'tgl' => 'required|date'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator);
        }

        Tgl::create([
            'tgl' => $request->tgl
        ]);

        return redirect()->back()->with('sukses', 'Data berhasil ditambahkan!, silahkan input user yang ingin bayar');
    }

    public function listKas($id)
    {
        $tgl_kas = Tgl::with('kas.user')->findOrFail($id); 
        $tanggal = Carbon::parse($tgl_kas->tgl)->translatedFormat('l, d F Y');
        $user_id = User::all();

        return view('superadmin.list-kas', compact('tgl_kas', 'tanggal', 'user_id'));
    }

    public function create_kas(Request $request, $id){
        $tgl_kas = Tgl::findOrFail($id);
        $rules = [
            'user_id'       => 'required',
            'setor'         => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return redirect()->back()->with('error', $validator);
        }

        Kas::create([
            'tgl_id'        => $tgl_kas->id,
            'user_id'       => $request->user_id,
            'setor'         => $request->setor
        ]);

        return redirect()->back()->with('sukses', 'Data berhasil ditambahkan!');
    }
}
