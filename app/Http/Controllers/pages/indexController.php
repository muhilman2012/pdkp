<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class indexController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function layanan(){
        return view('pages.layanan');
    }

    // Method untuk menampilkan dashboard
    public function dashboard()
    {
        $user = Auth::user();
        $permintaan = permintaan::where('user_id', $user->id)->get();
        return view('pages.dashboard', [
            'user' => $user,
            'permintaan' => $permintaan,
        ]);
    }

    // Method untuk menampilkan detail permintaan
    public function detail($id_permintaan)
    {
        $permintaan = permintaan::findOrFail($id_permintaan);
        return view('pages.detail', [
            'permintaan' => $permintaan,
        ]);
    }

    public function history()
    {
        $user = Auth::user();
        $permintaan = permintaan::where('user_id', $user->id)->get();
        return view('pages.history', [
            'user' => $user,
            'permintaan' => $permintaan,
        ]);
    }

    // Method untuk menyimpan review dan rating
    public function storeReview(Request $request, $id_permintaan)
    {
        $request->validate([
            'review' => 'required|string|max:255',
            'rating_ops' => 'required|integer|min:1|max:5',
            'rating_driver' => 'required|integer|min:1|max:5',
        ]);

        $permintaan = permintaan::findOrFail($id_permintaan);
        $permintaan->review = $request->input('review');
        $permintaan->rating_ops = $request->input('rating_ops');
        $permintaan->rating_driver = $request->input('rating_driver');
        $permintaan->save();

        return redirect()->route('pages.detail', ['id_permintaan' => $permintaan->id_permintaan])
            ->with('success', 'Review dan rating berhasil disimpan!');
    }

    // Method untuk membatalkan permintaan
    public function cancel($id_permintaan)
    {
        $permintaan = permintaan::findOrFail($id_permintaan);
        $permintaan->status = 'DIBATALKAN';
        $permintaan->save();

        return redirect()->route('pages.dashboard')
            ->with('success', 'Permintaan berhasil dibatalkan!');
    }
}
