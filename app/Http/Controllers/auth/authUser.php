<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\pengemudi;

class authUser extends Controller
{
    public function index()
    {
        if(Auth::guard('web')->check()){
            return redirect()->route('pages.dashboard');
        }
        return view('pages.index');
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(),  [
            'email' => 'required',
            'password' => 'required|min:8',
            'user_type' => 'required',
        ], [
            'email.required' => 'Masukan Email!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Oops password terlalu pendek!',
            'user_type.required' => 'Pilih tipe pengguna!',
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
            $credentials = ['email' => $request->email, 'password' => $request->password];

            if ($request->user_type == 'user') {
                if (Auth::guard('web')->attempt($credentials)) {
                    return redirect()->route('pages.dashboard')->with('success', 'Berhasil Login');
                }
            } elseif ($request->user_type == 'pengemudi') {
                if (Auth::guard('pengemudi')->attempt($credentials)) {
                    return redirect()->route('pengemudi.dashboard')->with('success', 'Berhasil Login');
                }
            }

            return redirect()->back()->with('error', 'Email atau Password Anda Salah!');
        }
    }

    public function logout()
    {
        if(Auth::guard('web')->check()){
            Auth::guard('web')->logout();
        } elseif (Auth::guard('pengemudi')->check()) {
            Auth::guard('pengemudi')->logout();
        }

        return redirect()->route('pages.index');
    }
}
