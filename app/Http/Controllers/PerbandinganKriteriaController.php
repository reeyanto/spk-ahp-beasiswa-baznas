<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerbandinganKriteriaRequest;
use App\Models\Kriteria;
use Illuminate\Support\Facades\DB;
use App\Models\PerbandinganKriteria;
use Illuminate\Http\Request;

class PerbandinganKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perbandingan = $this->getPerbandinganKriteria();

        $kriteria = DB::table('kriteria')->get();
        $perbandingan_kriteria = DB::table('perbandingan_kriteria')->get();

        // Generate matriks perbandingan
        $matrixData = $this->generateMatrixData($kriteria, $perbandingan_kriteria);
        $matrix = $matrixData['matrix'];
        $totals = $matrixData['totals'];

        // Normalisasi matriks
        $normalizedData = $this->normalizeMatrix($kriteria, $matrix, $totals);
        $normalized_matrix = $normalizedData['normalized_matrix'];
        $jumlah_per_baris = $normalizedData['jumlah_per_baris'];
        $prioritas_per_baris = $normalizedData['prioritas_per_baris'];

        // Hitung matriks penjumlahan
        $penjumlahanData = $this->calculatePenjumlahanMatrix($kriteria, $matrix, $prioritas_per_baris);
        $jumlah_baris_kolom = $penjumlahanData['jumlah_baris_kolom'];
        $jumlah_penjumlahan_per_baris = $penjumlahanData['jumlah_penjumlahan_per_baris'];


        // Hitung rasio konsistensi
        $cr = $this->calculateConsistencyRatio($kriteria, $jumlah_baris_kolom, $prioritas_per_baris);

        return view('admin.perbandingan-kriteria.index', compact(
            'perbandingan', 'kriteria', 'matrix', 'totals', 'normalized_matrix', 'jumlah_per_baris',
            'prioritas_per_baris', 'jumlah_baris_kolom', 'jumlah_penjumlahan_per_baris', 'cr',
        ));
    }

    private function getPerbandinganKriteria()
    {
        return DB::select("
            SELECT a.id AS id1, a.kode AS kode1, a.nama AS nama1, b.id AS id2, b.kode AS kode2, b.nama AS nama2, pk.nilai
            FROM kriteria AS a
            JOIN kriteria AS b
            ON a.id < b.id
            LEFT JOIN perbandingan_kriteria AS pk
            ON a.id = pk.kriteria_id1 AND b.id = pk.kriteria_id2
        ");
    }

    private function generateMatrixData($kriteria, $perbandingan_kriteria)
    {
        $matrix = [];
        $totals = [];

        foreach ($kriteria as $k1) {
            foreach ($kriteria as $k2) {
                $nilai = $perbandingan_kriteria->first(function ($item) use ($k1, $k2) {
                    return $item->kriteria_id1 == $k1->id && $item->kriteria_id2 == $k2->id;
                });

                $matrix[$k1->kode][$k2->kode] = $nilai->nilai ?? '-';

                if (is_numeric($matrix[$k1->kode][$k2->kode])) {
                    if (!isset($totals[$k2->kode])) {
                        $totals[$k2->kode] = 0;
                    }
                    $totals[$k2->kode] += $matrix[$k1->kode][$k2->kode];
                }
            }
        }

        return ['matrix' => $matrix, 'totals' => $totals];
    }

    private function normalizeMatrix($kriteria, $matrix, $totals)
    {
        $normalized_matrix = [];
        $jumlah_per_baris = [];
        $prioritas_per_baris = [];

        foreach ($kriteria as $k1) {
            $jumlah = 0;
            foreach ($kriteria as $k2) {
                if (is_numeric($matrix[$k1->kode][$k2->kode])) {
                    $nilai_normalisasi = $totals[$k2->kode] > 0 ? $matrix[$k1->kode][$k2->kode] / $totals[$k2->kode] : 0; // Pastikan tidak membagi dengan nol
                    $normalized_matrix[$k1->kode][$k2->kode] = $nilai_normalisasi;
                    $jumlah += $nilai_normalisasi;
                } else {
                    $normalized_matrix[$k1->kode][$k2->kode] = '-';
                }
            }
            $jumlah_per_baris[$k1->kode] = $jumlah;
            $prioritas_per_baris[$k1->kode] = $jumlah / count($kriteria);
        }

        return ['normalized_matrix' => $normalized_matrix, 'jumlah_per_baris' => $jumlah_per_baris, 'prioritas_per_baris' => $prioritas_per_baris];
    }


    private function calculatePenjumlahanMatrix($kriteria, $matrix, $prioritas_per_baris)
    {
        $jumlah_baris_kolom = [];
        
        foreach($kriteria as $baris_kode => $baris) {
            $jumlah_penjumlahan_per_baris[$baris->kode] = 0;
            foreach($kriteria as $kolom_kode => $kolom) {
                $jumlah_baris_kolom[$baris->kode][$kolom->kode] = $matrix[$baris->kode][$kolom->kode] * $prioritas_per_baris[$kolom->kode];
                $jumlah_penjumlahan_per_baris[$baris->kode] += $jumlah_baris_kolom[$baris->kode][$kolom->kode];
            }
        }

        return ['jumlah_baris_kolom' => $jumlah_baris_kolom, 'jumlah_penjumlahan_per_baris' => $jumlah_penjumlahan_per_baris];
    }


    private function calculateConsistencyRatio($kriteria, $jumlah_baris_kolom, $prioritas_per_baris)
    {
        $eigen_values = [];
        $jumlah_kriteria = count($kriteria);
        foreach ($kriteria as $baris_kode => $kolom) {
            $sum = array_sum($jumlah_baris_kolom[$baris_kode] ?? []);
            $eigen_values[$baris_kode] = $sum / ($prioritas_per_baris[$baris_kode] ?? 1);
        }
        $lambda_max = array_sum($eigen_values) / $jumlah_kriteria;

        // Hitung rasio konsistensi
        $ci = ($lambda_max - $jumlah_kriteria) / ($jumlah_kriteria - 1);
        $ri = [0, 0, 0.52, 0.89, 1.11, 1.25, 1.35, 1.40, 1.45, 1.49]; // Random Index untuk 1-10 kriteria
        $ri_value = $ri[$jumlah_kriteria - 1] ?? 0;
        
        return $ci / $ri_value;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PerbandinganKriteriaRequest $request)
    {
        $reqId1s = $request->input('id1');
        $reqId2s = $request->input('id2');
        $reqNilai = $request->input('nilai');

        $data = [];
        $i = 0;
        foreach ($reqNilai as $nilai) {
            // Simpan nilai perbandingan kriteria A dengan B
            PerbandinganKriteria::updateOrCreate([
                'kriteria_id1' => $reqId1s[$i],
                'kriteria_id2' => $reqId2s[$i],
            ], ['nilai' => (double) $nilai]);

            // Simpan nilai perbandingan kriteria B dengan A (Kebalikannya)
            $kebalikan = ['0.500' => '2', '0.333' => '3', '0.250' => '4', '0.200' => '5', '0.166' => '6', '0.142' => '7', '0.125' => '8', '0.111' => '9'];
            PerbandinganKriteria::updateOrCreate([
                'kriteria_id1' => $reqId2s[$i],
                'kriteria_id2' => $reqId1s[$i],
            ], ['nilai' => array_key_exists($nilai, $kebalikan) ? (double) $kebalikan[$nilai] : 1 / (double) $nilai]);

            // Simpan nilai perbandingan kriteria A dengan A (Dengan dirinya sendiri)
            PerbandinganKriteria::updateOrCreate([
                'kriteria_id1' => $reqId1s[$i],
                'kriteria_id2' => $reqId1s[$i],
            ], ['nilai' => 1]);

            $i++;
        }

        return redirect()->route('perbandingan-kriteria.index')->with('success', 'Data berhasil disimpan.');
    }
}
