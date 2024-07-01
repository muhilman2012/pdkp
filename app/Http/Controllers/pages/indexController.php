<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function dashboard(){
        $user = User::all();
        return view('pages.dashboard',[
            'user'  => $user,
        ]);
    }

    public function layanan(){
        return view('pages.layanan');
    }

    public function logout()
    {
        if(Auth::guard('web')->check()){
            Auth::guard('web')->logout();
            return view('pages.index');
        }
    }
}
