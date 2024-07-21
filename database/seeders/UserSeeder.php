<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\divisi;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisiData = [
            ['id_divisi' => 14, 'nama' => 'Biro Tata Usaha, Teknologi Informasi, dan Kepegawaian, Deputi Bidang Administrasi, Sekretariat Wakil Presiden'],
        ];

        foreach ($divisiData as $data) {
            $divisi = Divisi::where('id_divisi', $data['id_divisi'])->first();
            if ($divisi) {
                User::create([
                    'name'       => 'Demo',
                    'phone'      => '081234567890',
                    'unit_kerja' => $data['id_divisi'], // Menggunakan id_divisi dari data divisi
                    'email'      => 'demo@gmail.com',
                    'password'   => Hash::make('password123'),
                ]);
            }
        }
    }
}
