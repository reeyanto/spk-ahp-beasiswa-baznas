<?php

namespace Database\Seeders;

use App\Models\Periode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Periode::create([
            'nama' => 'Periode Pertama',
            'tahun' => '2024',
            'keterangan' => 'Periode pertama di tahun 2024'
        ]);
    }
}
