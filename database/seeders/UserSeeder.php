<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Demo',
            'nip'       => '1234567890987654321',
            'phone'     => '081234567890',
            'unit_kerja'=> 'protokol',
            'email'     => 'demo@gmail.com',
            'password'  => Hash::make('password123'),
        ]);
    }
}
