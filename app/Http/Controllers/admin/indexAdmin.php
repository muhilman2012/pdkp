<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\pengemudi;
use App\Models\permintaan;
use Illuminate\Support\Facades\Response;

class indexAdmin extends Controller
{
    // show dashboard
    public function index(){
        return view('admin.index');
    }

    public function permintaanReport()
    {
        $permintaan = permintaan::all();
        return view('admin.reports.permintaan', compact('permintaan'));
    }

    public function exportPermintaanToCSV()
    {
        $permintaan = permintaan::all();
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($permintaan, [
            'id_permintaan' => 'ID Permintaan',
            'layanan' => 'Layanan',
            'pengguna' => 'Pengguna',
            'phone' => 'No Telepon',
            'tujuan_akhir' => 'Tujuan',
            'waktu' => 'Waktu Permintaan',
            'status' => 'Status',
        ])->download();
    }

    public function logout()
    {
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        }
    }
}
