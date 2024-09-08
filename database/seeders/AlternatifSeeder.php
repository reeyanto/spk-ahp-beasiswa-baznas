<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alternatifs = [
            [
                'periode_id' => 1,
                'nama' => 'Adi Putra',
                'alamat' => 'Pangkalan Kerinci',
                'hp' => '081212345678',
                'jk' => 'L'
            ],
            [
                'periode_id' => 1,
                'nama' => 'Budi Santoso',
                'alamat' => 'Pangkalan Kerinci',
                'hp' => '081223456789',
                'jk' => 'L'
            ],
            [
                'periode_id' => 1,
                'nama' => 'Cindy Saputri',
                'alamat' => 'Pangkalan Kerinci',
                'hp' => '081234567890',
                'jk' => 'P'
            ],
            [
                'periode_id' => 1,
                'nama' => 'Dodi Supardi',
                'alamat' => 'Pangkalan Kerinci',
                'hp' => '081245678901',
                'jk' => 'L'
            ],
        ];

        foreach($alternatifs as $alternatif) {
            Alternatif::create($alternatif);
        }
    }
}
