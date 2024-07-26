<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\permintaan;
use App\Models\pengemudi;
use App\Models\kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
        $pengemudi = pengemudi::orderBy('jabatan')->get()->groupBy('jabatan');
        $kendaraan = kendaraan::all();

        return view('admin.permintaan.edit', compact('data', 'pengemudi', 'kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pengemudi_id'              => 'required',
            'kendaraan_id'              => 'required',  // Ubah dari 'kendaraan' menjadi 'kendaraan_id'
            'status'                    => 'required',
        ], [
            'pengemudi_id.required'     => 'Mohon pilih pengemudi',
            'kendaraan_id.required'     => 'Mohon pilih kendaraan',
            'status.required'           => 'Mohon pilih status',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cari data permintaan berdasarkan ID
        $data = permintaan::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // Cari data kendaraan berdasarkan ID
        $kendaraan = kendaraan::find($request->kendaraan_id);
        if (!$kendaraan) {
            return redirect()->back()->with('error', 'Data kendaraan tidak ditemukan');
        }

        // Update data permintaan
        $data->pengemudi_id     = $request->pengemudi_id;
        $data->kendaraan        = $kendaraan->name;
        $data->nopol            = $kendaraan->nopol;
        $data->warna            = $kendaraan->warna;
        $data->status           = $request->status;

        // Jika status berubah menjadi 'DIKONFIRMASI', simpan waktu sekarang ke kolom 'status_update'
        if ($request->status == 'DIKONFIRMASI') {
            $data->status_update = Carbon::now();
        }

        if ($data->save()) {
            return redirect()->route('admin.permintaan')->with('success', 'Permintaan berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui permintaan');
        }
    }
}
