<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriterias = [
            [
                'kode' => 'K1',
                'nama' => 'IPK',
                'keterangan' => 'Indeks Prestasi Komulatif Mahasiswa'
            ], 
            [
                'kode' => 'K2',
                'nama' => 'Penghasilan Orang Tua',
                'keterangan' => 'Jumlah Penghasilan Orang Tua Perbulan'
            ],
            [
                'kode' => 'K3',
                'nama' => 'Tanggungan Orang Tua',
                'keterangan' => 'Jumlah Tanggungan Orang Tua'
            ],
            [
                'kode' => 'K4',
                'nama' => 'Semester',
                'keterangan' => 'Semester Calon Penerima Saat Mendaftar'
            ]
        ];

        foreach($kriterias as $kriteria) {
            Kriteria::create($kriteria);
        }
    }
}
