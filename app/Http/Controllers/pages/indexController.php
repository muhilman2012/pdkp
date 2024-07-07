<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function layanan(){
        return view('pages.layanan');
    }

    public function dashboard(){
        $user = User::all();
        $permintaan = permintaan::all();
        return view('pages.dashboard',[
            'user'          => $user,
            'permintaan'    => $permintaan,
        ]);
    }

    public function logout()
    {
        if(Auth::guard('web')->check()){
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
}
