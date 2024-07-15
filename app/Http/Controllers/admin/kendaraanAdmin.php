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
            'title'        => 'required',
            'description'  => 'required',
            'content'      => 'required',
            // 'imagesMultiple.*'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'title.required'        => 'Please input field title kendaraan',
            'description.required'  => 'Please input field description users',
            'content.required'      => 'Please input field content users',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // slug from title
            $slug = Str::slug($request->title);
            // schedule
            $schedule = $request->dates . ' ' . date('H:i:s', strtotime($request->times));
            if ($request->images) {
                $validImages = Validator::make($request->all(), [
                    'images'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:4512',
                ], [
                    'images.image'          => 'File is not images',
                    'images.mimes'          => 'File must be images',
                    'images.max'            => 'File images oversized',
                ]);
                if ($validImages->fails()) {
                    return redirect()->back()->withErrors($validImages)->withInput();
                } else {
                    // images 
                    $resorce = $request->images;
                    $originNamaImages = $resorce->getClientOriginalName();
                    $NewNameImage = "IMG-" . substr(md5($originNamaImages . date("YmdHis")), 0, 14);
                    $namasamplefoto = $NewNameImage . "." . $resorce->getClientOriginalExtension();
                    // update with images
                    $data = User::find($id);
                    $data->title = $request->title;
                    $data->slug = $slug;
                    $data->description = $request->description;
                    $data->content = $request->content;
                    $data->images = $namasamplefoto;
                    $resorce->move(public_path() . "/images/users/", $namasamplefoto);
                    if ($data->save()) {
                        return redirect()->route('admin.users')->with('success', 'users data saved successfully');
                    } else {
                        return redirect()->back()->with('error', 'sorry database is busy try again letter');
                    }
                }
            } else {
                // update no images
                $data = kendaraan::find($id);
                $data->title = $request->title;
                $data->slug = $slug;
                $data->description = $request->description;
                $data->content = $request->content;
                if ($data->save()) {
                    return redirect()->route('admin.users')->with('success', 'users data saved successfully');
                } else {
                    return redirect()->back()->with('error', 'sorry database is busy try again letter');
                }
            }
        }
    }
}
