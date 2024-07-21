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

    public function dashboard(){
        $user = User::all();
        $permintaan = permintaan::all();
        return view('pages.dashboard',[
            'user'          => $user,
            'permintaan'    => $permintaan,
        ]);
    }

    public function detail($id_permintaan)
    {
        $permintaan = permintaan::findOrFail($id_permintaan);
        return view('pages.detail', [
            'permintaan' => $permintaan,
        ]);
    }

    public function storeReview(Request $request, $id_permintaan)
    {
        $validator = Validator::make($request->all(), [
            'review' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ], [
            'review.required' => 'Harap isi kolom review',
            'review.string'   => 'Review harus berupa teks',
            'review.max'      => 'Review tidak boleh lebih dari 255 karakter',
            'rating.required' => 'Harap pilih rating',
            'rating.integer'  => 'Rating harus berupa angka',
            'rating.min'      => 'Rating minimal adalah 1',
            'rating.max'      => 'Rating maksimal adalah 5',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $permintaan = permintaan::where('id_permintaan', $id_permintaan)->firstOrFail();
        $permintaan->review = $request->review;
        $permintaan->rating = $request->rating;
        $permintaan->save();

        return redirect()->route('pages.dashboard', ['id_permintaan' => $id_permintaan])->with('success', 'Terimakasih telah memberikan Review');
    }

}
