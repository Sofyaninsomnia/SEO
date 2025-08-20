<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
// use Hashids\Hashids;

class UserController extends Controller
{
    // protected $hashids;
    // public function __construct()
    // {
    //     $this->hashids = new Hashids(config('app.key'), 85);
    // }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function index()
    {
        $users = User::all();
        $roles = DB::table('users')->distinct()->pluck('role');
        return view('superadmin.user', compact('users', 'roles'));
    }

    public function add_user(Request $request)
    {
        $rules = [
            'name'      => 'required|string|min:4|max:100',
            'email'     => 'required|email|min:8|max:100',
            'password'  => 'required|string|min:6',
            'role'      => 'required|in:user,admin,superadmin',
            'jabatan'   => 'required|string|min:6|max:100'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'jabatan'   => $request->jabatan
        ]);

        return redirect()->route('user-list')->with('sukses', 'Data berhasil ditambahkan!');
    }

    public function changeDataUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rules = [
            'name'      => 'required|string|min:4|max:100',
            'email'     => 'required|email|min:8|max:100',
            'role'      => 'required|in:user,admin,superadmin',
            'jabatan'   => 'required|string|min:6|max:100'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validate = $request->validate($rules);

        $user->update($validate);
        return redirect()->route('user-list')->with('sukses', 'Data berhasil diperbarui!');
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user-list')->with('sukses', 'Data berhasil dihapus!');    
    }
}
