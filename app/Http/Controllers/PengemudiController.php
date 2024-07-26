<?php

namespace App\Http\Controllers;

use App\Models\permintaan;
use App\Models\pengemudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengemudiController extends Controller
{
    public function index()
    {
        $pengemudi = Auth::user();
        $permintaan = permintaan::where('pengemudi_id', $pengemudi->id)->get();

        return view('pengemudi.dashboard', compact('permintaan'));
    }

    public function show($id_permintaan)
    {
        $permintaan = permintaan::findOrFail($id_permintaan);

        return view('pengemudi.detail', compact('permintaan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $permintaan = permintaan::findOrFail($id);
        $permintaan->status = $request->status;
        $permintaan->save();

        return redirect()->route('pengemudi.dashboard')->with('success', 'Status permintaan berhasil diperbarui.');
    }

    public function history()
    {
        $pengemudiId = Auth::guard('pengemudi')->id();
        $permintaan = permintaan::where('pengemudi_id', $pengemudiId)
            ->where('status', 'SELESAI')
            ->orWhere('status', 'DIBATALKAN')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pengemudi.history', compact('permintaan'));
    }
}
