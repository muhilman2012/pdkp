<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Permintaan extends Model
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

    public $incrementing = false; // Pastikan primary key tidak auto-increment

    protected $keyType = 'string'; // Tipe primary key adalah string

    protected $fillable = [
        'id_permintaan',
        'uuid',
        'layanan',
        'waktu',
        'keperluan',
        'pengguna',
        'phone',
        'capacity',
        'jam_awal',
        'jam_akhir',
        'date',
        'tujuan_awal',
        'tujuan_akhir',
        'status',
        'pengemudi_id',
        'kendaraan',
        'file',
        'rating',
        'review',
        'pesan',
        'user_id',
    ];

    // Event booting untuk menghasilkan UUID saat membuat instance baru
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function pengemudi()
    {
        return $this->belongsTo(pengemudi::class, 'pengemudi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
