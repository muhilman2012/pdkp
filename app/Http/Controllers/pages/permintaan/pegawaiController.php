<?php

namespace App\Http\Controllers\pages\permintaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\permintaan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class pegawaiController extends Controller
{
    public function index()
    {
        return view('layanan.pegawai');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keperluan'                 => 'required',
            'jenis_pengguna'            => 'required',
            'capacity'                  => 'required',
            'tipe_perjalanan'           => 'required',
            'jam_awal'                  => 'required',
            'jam_akhir'                 => 'nullable',
            'date'                      => 'required',
            'tujuan_awal'               => 'required',
            'tujuan_akhir'              => 'required',
            'file'                      => 'nullable|mimes:pdf,doc,docx|max:5120', // validasi tipe file dan ukuran maksimum
        ], [
            'keperluan.required'        => 'Mohon isi Deskripsi Keperluan Permintaan',
            'jenis_pengguna.required'   => 'Mohon pilih jenis pengguna',
            'capacity.required'         => 'Mohon isi Jumlah Penumpang',
            'tipe_perjalanan.required'  => 'Mohon pilih Tipe Perjalanan',
            'jam_awal.required'         => 'Mohon isi Jam Pengantaran',
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

        // Tentukan waktu berdasarkan jam_awal
        $jam_awal = strtotime($request->jam_awal);
        $jam_kerja_mulai = strtotime("07:30");
        $jam_kerja_selesai = strtotime("16:00");

        if ($jam_awal >= $jam_kerja_mulai && $jam_awal <= $jam_kerja_selesai) {
            $waktu = 'Jam Kerja';
        } else {
            $waktu = 'Luar Jam Kerja / Lembur';
        }

        // Inisialisasi data permintaan
        $data = new permintaan();
        $data->uuid             = substr((string) Str::uuid(), 0, 10); // Generate UUID with 10 characters
        $data->waktu            = $waktu;
        $data->keperluan        = $request->keperluan;
        $data->capacity         = $request->capacity;
        $data->tipe_perjalanan  = $request->tipe_perjalanan;
        $data->jam_awal         = $request->jam_awal;
        $data->date             = $request->date;
        $data->tujuan_awal      = $request->tujuan_awal;
        $data->tujuan_akhir     = $request->tujuan_akhir;
        $data->file             = $file_name;
        $data->pesan            = $request->pesan; // Menyimpan pesan yang nullable

        // Menambahkan user_id dari pengguna yang sedang login
        $data->user_id          = Auth::id();

        // Periksa jenis pengguna
        if ($request->jenis_pengguna == 'sendiri') {
            // Ambil nama pengguna dan nomor telepon dari user yang sedang login
            $user = Auth::user();
            $data->pengguna = $user->name; // Sesuaikan dengan field name pada model User
            $data->phone = $user->phone; // Sesuaikan dengan field phone pada model User
        } else {
            // Validasi input pengguna dan phone
            $validator = Validator::make($request->all(), [
                'pengguna' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
            ], [
                'pengguna.required' => 'Mohon isi Nama Penumpang',
                'phone.required' => 'Mohon isi No HP Penumpang',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data->pengguna = $request->pengguna;
            $data->phone = $request->phone;
        }

        // Tambahkan data default
        $data->status           = 'BARU';  // status layanan terbaru
        $data->layanan          = 'Pegawai';  // default layanan pegawai

        if ($data->save()) {
            return redirect()->route('pages.dashboard')->with('success', 'Permintaan Kendaraan Berhasil');
        } else {
            return redirect()->back()->with('error', 'Terjadi Kesalahan saat melakukan Permintaan');
        }
    }
}