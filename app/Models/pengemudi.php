<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class pengemudi extends Authenticatable
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

    protected $hidden = [
        'password', 'remember_token',
    ];
}
