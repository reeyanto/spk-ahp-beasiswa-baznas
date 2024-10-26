<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $waktu = Carbon::now();
        $kriterias = [
            [
                'kode' => 'K1',
                'nama' => 'IPK',
                'keterangan' => 'Indeks Prestasi Komulatif Mahasiswa',
                'created_at' => $waktu->copy()->addSeconds(1),
                'updated_at' => $waktu->copy()->addSeconds(1),
            ], 
            [
                'kode' => 'K2',
                'nama' => 'Penghasilan Orang Tua',
                'keterangan' => 'Jumlah Penghasilan Orang Tua Perbulan',
                'created_at' => $waktu->copy()->addSeconds(2),
                'updated_at' => $waktu->copy()->addSeconds(2),
            ],
            [
                'kode' => 'K3',
                'nama' => 'Tanggungan Orang Tua',
                'keterangan' => 'Jumlah Tanggungan Orang Tua',
                'created_at' => $waktu->copy()->addSeconds(3),
                'updated_at' => $waktu->copy()->addSeconds(3),
            ],
            [
                'kode' => 'K4',
                'nama' => 'Semester',
                'keterangan' => 'Semester Calon Penerima Saat Mendaftar',
                'created_at' => $waktu->copy()->addSeconds(4),
                'updated_at' => $waktu->copy()->addSeconds(4),
            ]
        ];

        foreach($kriterias as $kriteria) {
            Kriteria::create($kriteria);
        }
    }
}
