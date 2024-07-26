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
    public function showLoginForm()
    {
        return view('pages.index');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'user_type' => 'required|in:user,pengemudi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if ($request->user_type == 'user') {
            if (Auth::guard('web')->attempt($credentials)) {
                return redirect()->route('pages.dashboard');
            } else {
                return redirect()->back()->with('error', 'Email atau Password Anda Salah!');
            }
        } elseif ($request->user_type == 'pengemudi') {
            if (Auth::guard('pengemudi')->attempt($credentials)) {
                return redirect()->route('pengemudi.dashboard');
            } else {
                return redirect()->back()->with('error', 'Email atau Password Anda Salah!');
            }
        }
    }

    public function logout()
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        return redirect()->route('login');
    }
}
