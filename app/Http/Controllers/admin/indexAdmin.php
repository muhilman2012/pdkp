<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\pengemudi;
use App\Models\permintaan;

class indexAdmin extends Controller
{
    // show dashboard
    public function index(){
        return view('admin.index');
    }

    public function logout()
    {
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        }
    }
}
