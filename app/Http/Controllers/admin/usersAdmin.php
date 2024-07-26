<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class usersAdmin extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        $divisis = divisi::all(); // Mengambil semua data divisi dari tabel

        return view('admin.users.create', compact('divisis'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'nip'           => 'required',
            'phone'         => 'required',
            'foto'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'         => 'required|min:8|email|max:255',
            'unit_kerja'    => 'required',
        ], [
            'name.required'       => 'Please input field Name!',
            'nip.required'        => 'Please input field NIP!',
            'phone.required'      => 'Please input field Phone!',
            'foto.required'       => 'Please upload Foto',
            'foto.image'          => 'File is not foto',
            'foto.mimes'          => 'File must be foto',
            'foto.max'            => 'File foto oversized',
            'email.required'      => 'Masukan alamat Email!',
            'email.min'           => 'Oops sepertinya bukan email!',
            'email.email'         => 'Alamat email anda salah!',
            'email.max'           => 'Oops email melampaui batas!',
            'unit_kerja'          => 'Please input field Unit Kerja',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // foto 
            $resorce = $request->foto;
            $extension = $resorce->getClientOriginalExtension();
            $requestName = $request->input('name'); // Mengambil nama dari request
            $cleanedName = str_replace(' ', '', $requestName); // Menghapus spasi dari nama
            $NewNameImage = "IMG-" . $cleanedName;
            $namasamplefoto = $NewNameImage . "." . $extension;
        
            $data = new User();
            $data->name = $request->name;
            $data->nip = $request->nip;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->unit_kerja = $request->unit_kerja;
        
            // Membuat password otomatis dengan format SWP-name tanpa spasi
            $autoPassword = "SWP-" . $cleanedName;
            $data->password = bcrypt($autoPassword);
        
            $data->foto = $namasamplefoto;
            $resorce->move(public_path() . "/images/users/", $namasamplefoto);
        
            if ($data->save()) {
                return redirect()->route('admin.users')->with('success', 'Data Pengguna Berhasil disimpan dengan Password : ' . $autoPassword);
            } else {
                return redirect()->back()->with('error', 'Sorry, the database is busy. Please try again later.');
            }
        }              
    }

    public function show($id)
    {
         $data= User::find($id);
         return view('admin.users.detail', [
             'data' => $data
         ]);
    }

    public function edit($id)
    {
        $data = User::find($id);
        $divisis = divisi::all();
        return view('admin.users.edit', compact('divisis','data'));
       
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'nip'           => 'required',
            'phone'         => 'required',
            'email'         => 'required|email|max:255',
            'unit_kerja'    => 'required',
            'foto'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password'      => 'nullable|min:8|confirmed', // Validasi password
        ], [
            'name.required'         => 'Please input field Name!',
            'nip.required'          => 'Please input field NIP!',
            'phone.required'        => 'Please input field Phone!',
            'email.required'        => 'Masukan alamat Email!',
            'email.email'           => 'Alamat email anda salah!',
            'email.max'             => 'Oops email melampaui batas!',
            'unit_kerja.required'   => 'Please input field Unit Kerja',
            'foto.image'            => 'File is not foto',
            'foto.mimes'            => 'File must be foto',
            'foto.max'              => 'File foto oversized',
            'password.min'          => 'Password harus terdiri dari minimal 8 karakter',
            'password.confirmed'    => 'Password konfirmasi tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cari data pengguna berdasarkan ID
        $data = User::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data->name = $request->name;
        $data->nip = $request->nip;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->unit_kerja = $request->unit_kerja;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($data->foto && file_exists(public_path('images/users/' . $data->foto))) {
                unlink(public_path('images/users/' . $data->foto));
            }

            // Upload foto baru
            $resorce = $request->foto;
            $extension = $resorce->getClientOriginalExtension();
            $requestName = $request->input('name'); // Mengambil nama dari request
            $cleanedName = str_replace(' ', '', $requestName); // Menghapus spasi dari nama
            $NewNameImage = "IMG-" . $cleanedName;
            $namasamplefoto = $NewNameImage . "." . $extension;

            $data->foto = $namasamplefoto;
            $resorce->move(public_path() . "/images/users/", $namasamplefoto);
        }

        // Update password jika diisi
        if ($request->password) {
            $data->password = bcrypt($request->password);
        }

        if ($data->save()) {
            return redirect()->route('admin.users')->with('success', 'Data Pengguna Berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Sorry, the database is busy. Please try again later.');
        }
    }
}
