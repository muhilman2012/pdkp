<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class permintaan extends Model
{
    use HasFactory;

    protected $casts = [
        'jam_awal' => 'datetime:H:i',
    ];

    // Menambahkan accessor untuk memformat jam_awal
    public function getJamAwalAttribute($value)
    {
        return Carbon::parse($value)->format('H:i') . ' WIB';
    }

    protected $table = 'permintaan';

    protected $primaryKey = 'id_permintaan';

    protected $fillable = [
        'layanan',
        'waktu',
        'keperluan',
        'pengguna',
        'phone',
        'capacity',
        'jam_awal',
        'jam_akhir',
        'date',
        'tujual_awal',
        'tujuan_akhir',
        'status',
        'pengemudi',
        'kendaraan',
        'file',
    ];
}
