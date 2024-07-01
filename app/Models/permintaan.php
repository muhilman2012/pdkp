<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permintaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'keperluan',
        'pengguna',
        'phone',
        'jam_awal',
        'jam_akhir',
        'waktu',
        'date',
        'tujual_awal',
        'tujuan_akhir',
        'file',
    ];
}
