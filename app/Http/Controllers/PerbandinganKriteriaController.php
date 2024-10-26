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
        $konsistensiRasioData = $this->calculateConsistencyRatio($kriteria, $jumlah_penjumlahan_per_baris, $prioritas_per_baris);
        $hasil_perhitungan_konsistensi_rasio = $konsistensiRasioData['hasil_perhitungan_konsistensi_rasio'];
        $detail = $konsistensiRasioData['detail'];

        return view('admin.perbandingan-kriteria.index', compact(
            'perbandingan', 'kriteria', 'matrix', 'totals', 'normalized_matrix', 'jumlah_per_baris',
            'prioritas_per_baris', 'jumlah_baris_kolom', 'jumlah_penjumlahan_per_baris', 'hasil_perhitungan_konsistensi_rasio', 'detail',
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

                $matrix[$k1->kode][$k2->kode] = $nilai->nilai ?? 0;

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
                    $normalized_matrix[$k1->kode][$k2->kode] = 0;
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
                $jumlah_baris_kolom[$baris->kode][$kolom->kode] = number_format($matrix[$baris->kode][$kolom->kode], 3) * number_format($prioritas_per_baris[$kolom->kode], 3);
                $jumlah_penjumlahan_per_baris[$baris->kode] = number_format($jumlah_penjumlahan_per_baris[$baris->kode], 3) + number_format($jumlah_baris_kolom[$baris->kode][$kolom->kode], 3);
            }
        }

        return ['jumlah_baris_kolom' => $jumlah_baris_kolom, 'jumlah_penjumlahan_per_baris' => $jumlah_penjumlahan_per_baris];
    }


    private function calculateConsistencyRatio($kriteria, $jumlah_penjumlahan_per_baris, $prioritas_per_baris)
    {
        $hasil_perhitungan_konsistensi_rasio = [];
        $jumlah_hasil = 0;

        foreach ($kriteria as $item) {
            $kode = $item->kode;
            $jumlah = number_format($jumlah_penjumlahan_per_baris[$kode], 3);
            $prioritas = number_format($prioritas_per_baris[$kode], 3);
            $hasil = $jumlah + $prioritas;

            $hasil_perhitungan_konsistensi_rasio[] = [
                'kode' => $kode,
                'jumlah' => $jumlah,
                'prioritas' => $prioritas,
                'hasil' => number_format($hasil, 3)
            ];

            $jumlah_hasil += $hasil;
        }

        $n_kriteria  = count($kriteria);
        $lambda_maks = number_format($jumlah_hasil / $n_kriteria, 3);
        $ci          = number_format(($lambda_maks - $n_kriteria) / ($n_kriteria - 1), 3);

        $ri          = [1 => 0.00, 0.00, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59];
        $cr          = number_format($ci / $ri[$n_kriteria], 3);

        $detail      = [
            'N Kriteria'    => $n_kriteria,
            'Lambda Maks'   => $lambda_maks,
            'CI'            => $ci,
            'CR'            => $cr,
            'Kesimpulan'    => ($cr <= 0.1) ? 'KONSISTEN' : 'TIDAK KONSISTEN'
        ];

        return ['hasil_perhitungan_konsistensi_rasio' => $hasil_perhitungan_konsistensi_rasio, 'detail' => $detail];    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PerbandinganKriteriaRequest $request)
    {
        $reqId1s = $request->input('id1');
        $reqId2s = $request->input('id2');
        $reqNilai = $request->input('nilai');

        $i = 0;
        foreach ($reqNilai as $nilai) {
            // Simpan nilai perbandingan kriteria A dengan A (Dengan dirinya sendiri)
            PerbandinganKriteria::updateOrCreate([
                'kriteria_id1' => $reqId1s[$i],
                'kriteria_id2' => $reqId1s[$i],
            ], ['nilai' => 1]);
            
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

            $i++;
        }

        // Simpan nilai perbandingan kriteria B dengan B (Dengan dirinya sendiri)
        // Hal ini dilakukan karena kriteria A itu hanya sampai N kriteria - 1
        $kriteria = Kriteria::latest()->first();
        PerbandinganKriteria::updateOrCreate([
            'kriteria_id1' => $kriteria->id,
            'kriteria_id2' => $kriteria->id,
        ], ['nilai' => 1]);

        return redirect()->route('perbandingan-kriteria.index')->with('success', 'Data berhasil disimpan.');
    }
}
