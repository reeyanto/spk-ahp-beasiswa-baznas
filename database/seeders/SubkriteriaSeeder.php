<?php

namespace Database\Seeders;

use App\Models\SubKriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubkriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subkriterias = [
            // IPK
            [
                'kriteria_id' => 1,
                'nama' => '4',
                'keterangan' => 'Sangat Baik'
            ],
            [
                'kriteria_id' => 1,
                'nama' => '3.60 - 3.90',
                'keterangan' => 'Baik'
            ],
            [
                'kriteria_id' => 1,
                'nama' => '3.00 - 3.50',
                'keterangan' => 'Cukup'
            ],
            [
                'kriteria_id' => 1,
                'nama' => '< 2.90',
                'keterangan' => 'Kurang'
            ],

            // Penghasilan Orang Tua
            [
                'kriteria_id' => 2,
                'nama' => '< 1.500.000',
                'keterangan' => 'Sangat Baik'
            ],
            [
                'kriteria_id' => 2,
                'nama' => '1.500.000 - 2.000.000',
                'keterangan' => 'Baik'
            ],
            [
                'kriteria_id' => 2,
                'nama' => '2.000.000 - 3.000.000',
                'keterangan' => 'Cukup'
            ],
            [
                'kriteria_id' => 2,
                'nama' => '> 3.000.000',
                'keterangan' => 'Kurang'
            ],


            // Tanggungan Orang Tua
            [
                'kriteria_id' => 3,
                'nama' => '> 4',
                'keterangan' => 'Sangat Baik'
            ],
            [
                'kriteria_id' => 3,
                'nama' => '4',
                'keterangan' => 'Baik'
            ],
            [
                'kriteria_id' => 3,
                'nama' => '3',
                'keterangan' => 'Cukup'
            ],
            [
                'kriteria_id' => 3,
                'nama' => '<= 2',
                'keterangan' => 'Kurang'
            ],


            // Semester
            [
                'kriteria_id' => 4,
                'nama' => '3',
                'keterangan' => 'Sangat Baik'
            ],
            [
                'kriteria_id' => 4,
                'nama' => '4',
                'keterangan' => 'Baik'
            ],
            [
                'kriteria_id' => 4,
                'nama' => '5',
                'keterangan' => 'Cukup'
            ],
            [
                'kriteria_id' => 4,
                'nama' => '6',
                'keterangan' => 'Kurang'
            ],
        ];

        foreach($subkriterias as $subkriteria) {
            SubKriteria::create($subkriteria);
        }
    }
}
