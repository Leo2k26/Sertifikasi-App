<?php

namespace Database\Seeders;

use App\Models\Skema;
use Illuminate\Database\Seeder;

class SkemaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['SKM-01', 'Junior Web Developer', 'Skema sertifikasi kompetensi pengembangan aplikasi web tingkat pemula.'],
            ['SKM-02', 'Junior Graphic Designer', 'Skema sertifikasi kompetensi desain grafis tingkat pemula.'],
            ['SKM-03', 'Junior Network Administrator', 'Skema sertifikasi kompetensi administrasi jaringan tingkat pemula.'],
        ];

        foreach ($data as [$kode, $nama, $deskripsi]) {
            Skema::create(['kode_skema' => $kode, 'nama_skema' => $nama, 'deskripsi' => $deskripsi]);
        }
    }
}
