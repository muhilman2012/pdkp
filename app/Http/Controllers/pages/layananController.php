<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class layananController extends Controller
{
    public function pegawai(){
        return view('layanan.pegawai');
    }
}
