<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\permintaan;
use App\Models\pengemudi;
use App\Models\kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class permintaanAdmin extends Controller
{
    public function index()
    {
        return view('admin.permintaan.index');
    }

    public function create()
    {
        $pengemudi = pengemudi::all();
        $kendaraan = kendaraan::all();
        return view('admin.permintaan.create', compact('pengemudi', 'kendaraan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'waktu'                     => 'required',
            'keperluan'                 => 'required',
            'jenis_pengguna'            => 'required',
            'capacity'                  => 'required',
            'tipe_perjalanan'           => 'required',
            'jam_awal'                  => 'required',
            'jam_akhir'                 => 'required',
            'date'                      => 'required',
            'tujuan_awal'               => 'required',
            'tujuan_akhir'              => 'required',
            'file'                      => 'nullable|mimes:pdf,doc,docx|max:5120', // validasi tipe file dan ukuran maksimum
        ], [
            'waktu.required'            => 'Mohon pilih Waktu Permintaan',
            'keperluan.required'        => 'Mohon isi Deskripsi Keperluan Permintaan',
            'jenis_pengguna.required'   => 'Mohon pilih jenis pengguna',
            'capacity.required'         => 'Mohon isi Jumlah Penumpang',
            'tipe_perjalanan.required'  => 'Mohon pilih Tipe Perjalanan',
            'jam_awal.required'         => 'Mohon isi Jam Pengantaran',
            'jam_akhir.required'        => 'Mohon isi Jam Penjemputan',
            'date.required'             => 'Mohon isi Tanggal Pengantaran',
            'tujuan_awal.required'      => 'Mohon isi Lokasi Awal Pengantaran',
            'tujuan_akhir.required'     => 'Mohon isi Lokasi Akhir Pengantaran',
            'file.mimes'                => 'Tipe File Surat Tugas harus berupa PDF/DOC',
            'file.max'                  => 'Ukuran File Notulen Maksimal 5MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file_name = null;
        if ($request->hasFile('file')) {
            // Simpan file PDF ke dalam folder surat tugas jika diunggah
            $file_name = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('public/file/surat_tugas', $file_name);
        }

        // Inisialisasi data permintaan
        $data = new permintaan();
        $data->uuid             = substr((string) Str::uuid(), 0, 10); // Generate UUID with 10 characters
        $data->waktu            = $request->waktu;
        $data->keperluan        = $request->keperluan;
        $data->capacity         = $request->capacity;
        $data->tipe_perjalanan  = $request->tipe_perjalanan;
        $data->jam_awal         = $request->jam_awal;
        $data->jam_akhir        = $request->jam_akhir;
        $data->date             = $request->date;
        $data->tujuan_awal      = $request->tujuan_awal;
        $data->tujuan_akhir     = $request->tujuan_akhir;
        $data->file             = $file_name;

        if ($data->save()) {
            return redirect()->route('admin.permintaan')->with('success', 'Permintaan permintaan Berhasil');
        } else {
            return redirect()->back()->with('error', 'Terjadi Kesalahan saat melakukan Permintaan');
        }
    }

    public function show($id)
    {
         $data= permintaan::find($id);
         return view('admin.permintaan.detail', [
             'data' => $data
         ]);
    }

    public function edit($id)
    {
        $data = permintaan::find($id);
        $pengemudi = pengemudi::all();
        $kendaraan = kendaraan::all();

        return view('admin.permintaan.edit', compact('data', 'pengemudi', 'kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required',
            'description'  => 'required',
            'content'      => 'required',
            // 'imagesMultiple.*'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'title.required'        => 'Please input field title permintaan',
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
                $data = permintaan::find($id);
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
