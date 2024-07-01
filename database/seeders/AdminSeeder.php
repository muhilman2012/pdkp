<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\admins;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        admins::create([
            'username'  => 'Super Admin Setwapres RI',
            'email'     => 'admin@set.wapresri.go.id',
            'avatar'    => 'sample-images.png',
            'address'   => 'Jl. Kebon Sirih 14',
            'password'  => Hash::make('Setwapres2024@'),
        ]);
    }
}