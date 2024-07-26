<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\pengemudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class pengemudiAdmin extends Controller
{
    public function index()
    {
        return view('admin.pengemudi.index');
    }

    public function create()
    {
        return view('admin.pengemudi.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'nip'          => 'nullable',
            'jabatan'      => 'nullable',
            'phone'        => 'required',
            'email'        => 'required|min:8|email|max:255',
            'foto'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required'       => 'Harap isi Nama Pengemudi',
            'phone.required'      => 'Harap isi Nomor Pengemudi',
            'email.required'      => 'Harap isi Email Pengemudi',
            'email.min'           => 'Oops sepertinya bukan email!',
            'email.email'         => 'Alamat email anda salah!',
            'email.max'           => 'Oops email melampaui batas!',
            'foto.required'       => 'Please upload images',
            'foto.image'          => 'File is not images',
            'foto.mimes'          => 'File must be images',
            'foto.max'            => 'File images oversized',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Handle image upload
            $resorce = $request->foto;
            $pengemudiName = $request->input('name');
            $originNamaImages = $resorce->getClientOriginalName();
            $NewNameImage = "IMG-" . $pengemudiName;
            $namasamplefoto = $NewNameImage . "." . $resorce->getClientOriginalExtension();
        
            // Generate password
            $cleanedName = str_replace(' ', '', $pengemudiName); // Remove spaces from name
            $generatedPassword = 'SWP-' . $cleanedName;
        
            // Save data to database
            $data = new pengemudi();
            $data->name     = $request->name;
            $data->nip      = $request->nip;
            $data->jabatan  = $request->jabatan;
            $data->phone    = $request->phone;
            $data->email    = $request->email;
            $data->foto     = $namasamplefoto;
            $data->password = bcrypt($generatedPassword); // Encrypt the password
            $resorce->move(public_path() . "/images/pengemudi/", $namasamplefoto);
        
            if ($data->save()) {
                return redirect()->route('admin.pengemudi')->with('success', 'Data Pengemudi Berhasil Ditambah dengan password : ' . $generatedPassword);
            } else {
                return redirect()->back()->with('error', 'Maaf, database sedang sibuk. Coba lagi nanti.');
            }
        }        
    }

    public function show($id)
    {
         $data= pengemudi::find($id);
         return view('admin.pengemudi.detail', [
             'data' => $data
         ]);
    }

    public function edit($id)
    {
        $data = pengemudi::find($id);
        return view('admin.pengemudi.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'nip'          => 'nullable',
            'jabatan'      => 'nullable',
            'phone'        => 'required',
            'email'        => 'required|min:8|email|max:255',
            'foto'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password'     => 'nullable|min:8|confirmed', // Validasi password
        ], [
            'name.required'       => 'Harap isi Nama Pengemudi',
            'phone.required'      => 'Harap isi Nomor Pengemudi',
            'email.required'      => 'Harap isi Email Pengemudi',
            'email.min'           => 'Oops sepertinya bukan email!',
            'email.email'         => 'Alamat email anda salah!',
            'email.max'           => 'Oops email melampaui batas!',
            'foto.image'          => 'File is not images',
            'foto.mimes'          => 'File must be images',
            'foto.max'            => 'File images oversized',
            'password.min'        => 'Password harus terdiri dari minimal 8 karakter',
            'password.confirmed'  => 'Password konfirmasi tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = pengemudi::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data->name     = $request->name;
        $data->nip      = $request->nip;
        $data->jabatan  = $request->jabatan;
        $data->phone    = $request->phone;
        $data->email    = $request->email;

        if ($request->hasFile('foto')) {
            if ($data->foto && file_exists(public_path('images/pengemudi/' . $data->foto))) {
                unlink(public_path('images/pengemudi/' . $data->foto));
            }

            $resource = $request->foto;
            $pengemudiName = $request->input('name');
            $cleanedName = str_replace(' ', '', $pengemudiName);
            $newNameImage = "IMG-" . $cleanedName;
            $namasamplefoto = $newNameImage . "." . $resource->getClientOriginalExtension();

            $data->foto = $namasamplefoto;
            $resource->move(public_path() . "/images/pengemudi/", $namasamplefoto);
        }

        if ($request->password) {
            $data->password = bcrypt($request->password);
        }

        if ($data->save()) {
            return redirect()->route('admin.pengemudi')->with('success', 'Data Pengemudi Berhasil Diperbarui');
        } else {
            return redirect()->back()->with('error', 'Maaf, database sedang sibuk. Coba lagi nanti.');
        }
    }
}
