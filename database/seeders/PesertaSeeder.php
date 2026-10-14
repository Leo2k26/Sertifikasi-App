<?php

namespace Database\Seeders;

use App\Models\Peserta;
use Illuminate\Database\Seeder;

class PesertaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['3201010101010001', 'Ahmad Fauzi', 'ahmad@mail.com', '081234567890', 'Jakarta', 1],
            ['3201010101010002', 'Siti Nurhaliza', 'siti@mail.com', '081234567891', 'Bandung', 1],
            ['3201010101010003', 'Budi Santoso', 'budi@mail.com', '081234567892', 'Surabaya', 2],
        ];

        foreach ($data as [$nik, $nama, $email, $hp, $alamat, $skemaId]) {
            Peserta::create([
                'nik' => $nik,
                'nama' => $nama,
                'email' => $email,
                'no_hp' => $hp,
                'alamat' => $alamat,
                'skema_id' => $skemaId,
            ]);
        }
    }
}
