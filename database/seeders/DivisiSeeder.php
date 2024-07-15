<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\divisi;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisi = [
            ['id_divisi' => 1, 'nama' => 'Asisten Deputi Ekonomi dan Keuangan, Deputi Bidang Dukungan Kebijakan Pembangunan Ekonomi dan Peningkatan Daya Saing, Sekretariat Wakil Presiden'],
            ['id_divisi' => 2, 'nama' => 'Asisten Deputi Industri, Perdagangan, Pariwisata, dan Ekonomi Kreatif, Deputi Bidang Dukungan Kebijakan Pembangunan Ekonomi dan Peningkatan Daya Saing, Sekretariat Wakil Presiden'],
            ['id_divisi' => 3, 'nama' => 'Asisten Deputi Infrastruktur, Ketahanan Energi, dan Sumber Daya Alam, Deputi Bidang Dukungan Kebijakan Pembangunan Ekonomi dan Peningkatan Daya Saing, Sekretariat Wakil Presiden'],
            ['id_divisi' => 4, 'nama' => 'Asisten Deputi Penanggulangan Kemiskinan, Deputi Bidang Dukungan Kebijakan Pembangunan Manusia dan Pemerataan Pembangunan, Sekretariat Wakil Presiden'],
            ['id_divisi' => 5, 'nama' => 'Asisten Deputi Pembangunan Sumber Daya Manusia, Deputi Bidang Dukungan Kebijakan Pembangunan Manusia dan Pemerataan Pembangunan, Sekretariat Wakil Presiden'],
            ['id_divisi' => 6, 'nama' => 'Asisten Deputi Pemberdayaan Masyarakat dan Penanggulangan Bencana, Deputi Bidang Dukungan Kebijakan Pembangunan Manusia dan Pemerataan Pembangunan, Sekretariat Wakil Presiden'],
            ['id_divisi' => 7, 'nama' => 'Asisten Deputi Hubungan Luar Negeri, Deputi Bidang Dukungan Kebijakan Pemerintahan dan Wawasan Kebangsaan, Sekretariat Wakil Presiden'],
            ['id_divisi' => 8, 'nama' => 'Asisten Deputi Politik, Hukum, dan Otonomi Daerah, Deputi Bidang Dukungan Kebijakan Pemerintahan dan Wawasan Kebangsaan, Sekretariat Wakil Presiden'],
            ['id_divisi' => 9, 'nama' => 'Asisten Deputi Wawasan Kebangsaan, Pertahanan, dan Keamanan, Deputi Bidang Dukungan Kebijakan Pemerintahan dan Wawasan Kebangsaan, Sekretariat Wakil Presiden'],
            ['id_divisi' => 10, 'nama' => 'Asisten Deputi Tata Kelola Pemerintahan, Deputi Bidang Dukungan Kebijakan Pemerintahan dan Wawasan Kebangsaan, Sekretariat Wakil Presiden'],
            ['id_divisi' => 11, 'nama' => 'Biro Protokol dan Kerumahtanggaan, Deputi Bidang Administrasi, Sekretariat Wakil Presiden'],
            ['id_divisi' => 12, 'nama' => 'Biro Pers, Media, dan Informasi, Deputi Bidang Administrasi, Sekretariat Wakil Presiden'],
            ['id_divisi' => 13, 'nama' => 'Biro Perencanaan dan Keuangan, Deputi Bidang Administrasi, Sekretariat Wakil Presiden'],
            ['id_divisi' => 14, 'nama' => 'Biro Tata Usaha, Teknologi Informasi, dan Kepegawaian, Deputi Bidang Administrasi, Sekretariat Wakil Presiden'],
            ['id_divisi' => 15, 'nama' => 'Biro Umum, Deputi Bidang Administrasi, Sekretariat Wakil Presiden'],
            ['id_divisi' => 16, 'nama' => 'Lainnya'],
        ];

        DB::table('divisi')->insert($divisi);
    }
}
