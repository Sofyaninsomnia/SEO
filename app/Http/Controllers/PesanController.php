<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    public function user()
    {
        Carbon::setLocale('id');
        $pesan  = Pesan::latest()->paginate(5);
        $userSend = Pesan::where('user_id', Auth::id())->exists();
        return view('user.pesan', compact('pesan', 'userSend'));
    }

    public function admin()
    {
        Carbon::setLocale('id');
        $pesan  = Pesan::latest()->paginate(5);
        $userSend = Pesan::where('user_id', Auth::id())->exists();
        return view('admin.pesan', compact('pesan', 'userSend') );
    }

    public function super()
    {
        $pesan = Pesan::with('user')->get();
        return view('superadmin.pesan', compact('pesan'));
    }

    public function send_chat(Request $request){
        $rules = [
            'chat'  => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->with('error', 'Gagal mengirim saran! Silahkan coba lagi');
        }

        Pesan::create([
            'user_id'   => Auth::user()->id,
            'chat'      => $request->chat,
        ]);

        return redirect()->back()->with('sukses', 'Pesan berhasil dikirim   !');
    }

    public function show_feedback($id){
        $pesan = Pesan::findOrFail($id);
        return view('user.show-feedback', compact('pesan'));
    }

    public function delete_pesan($id){
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();
        return redirect()->back()->with('sukses', 'Data berhasil dihapus');
    }

    public function feedback($id){
        $pesan = Pesan::findOrFail($id);
        return view('superadmin.feedback', compact('pesan'));
    }

    public function update_feedback(Request $request, $id)
    {
        // dd($request->all());
        $feedback = Pesan::findOrFail($id);
        $rules = [
            'feedback'  => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator)->withInput();
        }

        $validate = $request->validate($rules);

        $feedback->update($validate);

        return redirect()->route('list.pesan')->with('sukses', 'Feedback berhasil di kirim');
    }
}
