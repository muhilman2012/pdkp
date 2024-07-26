<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class kendaraanAdmin extends Controller
{
    public function index()
    {
        return view('admin.kendaraan.index');
    }

    public function create()
    {
        return view('admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'merk'          => 'required',
            'type'          => 'nullable',
            'nopol'         => 'required',
            'jenis_bensin'  => 'nullable',
            'model'         => 'nullable',
            'warna'         => 'nullable',
            'kategori'      => 'required',
            'rute'          => 'nullable',
            'tahun'         => 'required',
            'images'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required'         => 'Harap isi Nama Kendaraan',
            'merk.required'         => 'Harap isi Merk Kendaraan',
            'nopol.required'        => 'Harap isi Nomor Polisi Kendaraan',
            'jenis_bensin.required' => 'Harap isi Jenis Bensin Kendaraan',
            'tahun.required'        => 'Harap isi Tahun Kendaraan',
            'images.image'          => 'File is not images',
            'images.mimes'          => 'File must be images',
            'images.max'            => 'File images oversized',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $data = new Kendaraan();
            $data->name = $request->name;
            $data->merk = $request->merk;
            $data->type = $request->type;
            $data->nopol = $request->nopol;
            $data->jenis_bensin = $request->jenis_bensin;
            $data->model = $request->model;
            $data->warna = $request->warna;
            $data->kategori = $request->kategori;
            $data->rute = $request->rute;
            $data->tahun = $request->tahun;

            // Proses gambar jika ada
            if ($request->hasFile('images')) {
                // Ambil file gambar dari request
                $resource = $request->file('images');

                // Ambil nama asli dan ekstensi gambar
                $originalName = $resource->getClientOriginalName();
                $extension = $resource->getClientOriginalExtension();

                // Ambil nama kendaraan dari request
                $kendaraanName = $request->input('name');

                // Buat nama baru untuk gambar
                $newNameImage = "IMG-" . $kendaraanName . "-" . time() . "." . $extension;

                // Tentukan path penyimpanan
                $destinationPath = public_path('/images/kendaraan'); // atau path lain sesuai kebutuhan Anda

                // Pindahkan file ke lokasi tujuan dengan nama baru
                $resource->move($destinationPath, $newNameImage);

                // Simpan informasi gambar ke database
                $data->images = $newNameImage;
            }

            if ($data->save()) {
                return redirect()->route('admin.kendaraan')->with('success', 'Data Kendaraan Berhasil Disimpan!');
            } else {
                return redirect()->back()->with('error', 'Maaf, database sedang sibuk. Coba lagi nanti.');
            }
        }
    }

    public function show($id)
    {
         $data= kendaraan::find($id);
         return view('admin.kendaraan.detail', [
             'data' => $data
         ]);
    }

    public function edit($id)
    {
        $data = kendaraan::find($id);
        return view('admin.kendaraan.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'merk'          => 'required',
            'type'          => 'nullable',
            'nopol'         => 'required',
            'jenis_bensin'  => 'nullable',
            'model'         => 'nullable',
            'warna'         => 'nullable',
            'kategori'      => 'required',
            'rute'          => 'nullable',
            'tahun'         => 'required',
            'images'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required'         => 'Harap isi Nama Kendaraan',
            'merk.required'         => 'Harap isi Merk Kendaraan',
            'nopol.required'        => 'Harap isi Nomor Polisi Kendaraan',
            'jenis_bensin.required' => 'Harap isi Jenis Bensin Kendaraan',
            'tahun.required'        => 'Harap isi Tahun Kendaraan',
            'images.image'          => 'File is not images',
            'images.mimes'          => 'File must be images',
            'images.max'            => 'File images oversized',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = kendaraan::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data->name = $request->name;
        $data->merk = $request->merk;
        $data->type = $request->type;
        $data->nopol = $request->nopol;
        $data->jenis_bensin = $request->jenis_bensin;
        $data->model = $request->model;
        $data->warna = $request->warna;
        $data->kategori = $request->kategori;
        $data->rute = $request->rute;
        $data->tahun = $request->tahun;

        if ($request->hasFile('images')) {
            if ($data->images && file_exists(public_path('images/kendaraan/' . $data->images))) {
                unlink(public_path('images/kendaraan/' . $data->images));
            }

            $resource = $request->file('images');
            $kendaraanName = $request->input('name');
            $originalName = $resource->getClientOriginalName();
            $extension = $resource->getClientOriginalExtension();
            $newNameImage = "IMG-" . $kendaraanName . "-" . time() . "." . $extension;
            $destinationPath = public_path('/images/kendaraan');
            $resource->move($destinationPath, $newNameImage);
            $data->images = $newNameImage;
        }

        if ($data->save()) {
            return redirect()->route('admin.kendaraan')->with('success', 'Data Kendaraan Berhasil Diperbarui');
        } else {
            return redirect()->back()->with('error', 'Maaf, database sedang sibuk. Coba lagi nanti.');
        }
    }
}
