<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengemudi extends Model
{
    use HasFactory;

    protected $table = 'pengemudi';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'nip',
        'phone',
        'email',
        'foto',
    ];
}
