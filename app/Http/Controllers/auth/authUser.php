<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

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
        ], [
            'email.required' => 'Masukan Email!',
    
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Oops password terlalu pendek!',
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }else{
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('pages.dashboard')->with('success', 'Berhasil Login');
            } else {
                return redirect()->back()->with('error', 'Email atau Password Anda Salah!');
            }
        }
    }

    public function logout()
    {
        if(Auth::guard('web')->check()){
            Auth::guard('web')->logout();
            return redirect()->route('pages.index');
        }
    }
}
