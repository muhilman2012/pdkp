<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class profileUser extends Controller
{
    // show profile user
    public function index()
    {
        $user = Auth::user();
        return view('pages.profile',[
            'user'  => $user,
        ]);
    }
}
