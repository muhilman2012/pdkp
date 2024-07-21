<?php

namespace App\Http\Controllers;

use App\Models\permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengemudiController extends Controller
{
    public function index()
    {
        $pengemudi = Auth::user();
        $permintaan = permintaan::where('pengemudi_id', $pengemudi->id)->get();

        return view('pengemudi.dashboard', compact('permintaan'));
    }

    public function show($id)
    {
        $permintaan = permintaan::findOrFail($id);

        return view('pengemudi.detail', compact('permintaan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $permintaan = permintaan::findOrFail($id);
        $permintaan->status = $request->status;
        $permintaan->save();

        return redirect()->route('pengemudi.dashboard')->with('success', 'Status permintaan berhasil diperbarui.');
    }
}
