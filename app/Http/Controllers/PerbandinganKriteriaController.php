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
    public function index2()
    {
        $perbandingan_kriteria = DB::select("
            SELECT a.id AS id1, a.kode AS kode1, a.nama AS nama1, b.id AS id2, b.kode AS kode2, b.nama AS nama2, pk.nilai
            FROM kriteria AS a
            JOIN kriteria AS b
            ON a.id < b.id
            LEFT JOIN perbandingan_kriteria AS pk
            ON a.id = pk.kriteria_id1 AND b.id = pk.kriteria_id2
        ");

        $kriteria = Kriteria::all();

        return view('admin.perbandingan-kriteria.index', compact('perbandingan_kriteria', 'kriteria'));
    }

    public function index() {
        // TABEL PERBANDINGAN KRITERIA
        // --------------
        // Ambil data untuk perbandingan
        $perbandingan = DB::select("
            SELECT a.id AS id1, a.kode AS kode1, a.nama AS nama1, b.id AS id2, b.kode AS kode2, b.nama AS nama2, pk.nilai
            FROM kriteria AS a
            JOIN kriteria AS b
            ON a.id < b.id
            LEFT JOIN perbandingan_kriteria AS pk
            ON a.id = pk.kriteria_id1 AND b.id = pk.kriteria_id2
        ");


        // TABEL MATRIKS PERBANDINGAN KRITERIA
        // -----------------
        $kriteria = DB::table('kriteria')->get();
        $perbandingan_kriteria = DB::table('perbandingan_kriteria')->get();

        // Buat array kosong untuk menampung matriks
        $matrix = [];
        $totals = [];

        // Isi matriks dengan nilai perbandingan kriteria dan hitung total kolom
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

        // TABEL MATRIKS NILAI KRITERIA (NORMALISASI)
        // Inisialisasi array untuk menyimpan matriks normalisasi, jumlah per baris, dan prioritas
        $normalized_matrix = [];
        $jumlah_per_baris = [];
        $prioritas_per_baris = [];

        // Normalisasi matriks dengan membagi setiap elemen dengan jumlah kolomnya
        foreach ($kriteria as $k1) {
            $jumlah = 0;
            foreach ($kriteria as $k2) {
                if (is_numeric($matrix[$k1->kode][$k2->kode])) {
                    $nilai_normalisasi = $matrix[$k1->kode][$k2->kode] / $totals[$k2->kode];
                    $normalized_matrix[$k1->kode][$k2->kode] = $nilai_normalisasi;
                    $jumlah += $nilai_normalisasi;
                } else {
                    $normalized_matrix[$k1->kode][$k2->kode] = '-';
                }
            }
            $jumlah_per_baris[$k1->kode] = $jumlah;
            $prioritas_per_baris[$k1->kode] = $jumlah / count($kriteria);
        }

        // TABEL MATRIKS PENJUMLAHAN SETIAP BARIS
        $matrix_penjumlahan = [];
        foreach ($kriteria as $baris_kode => $kolom) {
            foreach ($kriteria as $kolom_kode => $nilai) {
                $nilai_perbandingan = $matrix[$baris_kode][$kolom_kode] ?? 0;
                $prioritas = $prioritas_per_baris[$baris_kode] ?? 0;
                $matrix_penjumlahan[$baris_kode][$kolom_kode] = $nilai_perbandingan * $prioritas;
            }
        }


        // Hitung jumlah per baris untuk matriks penjumlahan
        $jumlah_penjumlahan_per_baris = [];
        foreach ($matrix_penjumlahan as $baris_kode => $kolom) {
            $jumlah_penjumlahan_per_baris[$baris_kode] = array_sum($kolom);
        }

        // Hitung rasio konsistensi
        $eigen_values = [];
        $jumlah_kriteria = count($kriteria);
        foreach ($kriteria as $baris_kode => $kolom) {
            $sum = array_sum($matrix_penjumlahan[$baris_kode] ?? []);
            $eigen_values[$baris_kode] = $sum / ($prioritas_per_baris[$baris_kode] ?? 1);
        }
        $lambda_max = array_sum($eigen_values) / $jumlah_kriteria;

        // Hitung rasio konsistensi
        $ci = ($lambda_max - $jumlah_kriteria) / ($jumlah_kriteria - 1);
        $ri = [0, 0, 0.52, 0.89, 1.11, 1.25, 1.35, 1.40, 1.45, 1.49]; // Random Index untuk 1-10 kriteria
        $ri_value = $ri[$jumlah_kriteria - 1] ?? 0;
        $cr = $ci / $ri_value;

        // Kembalikan ke view
        return view('admin.perbandingan-kriteria.index', compact(
            'perbandingan', 'kriteria', 'matrix', 'totals', 'normalized_matrix', 'jumlah_per_baris',
            'prioritas_per_baris', 'matrix_penjumlahan', 'jumlah_penjumlahan_per_baris', 'cr'
        ));
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
        foreach($reqNilai as $nilai) {
            // simpan nilai perbandingan kriteria A dengan B
            PerbandinganKriteria::updateOrCreate([
                'kriteria_id1' => $reqId1s[$i],
                'kriteria_id2' => $reqId2s[$i],
            ], ['nilai' => (double) $nilai]);

            // simpan nilai perbandingan kriteria B dengan A (Kebalikannya)
            $kebalikan = ['0.500' => '2', '0.333' => '3', '0.250' => '4', '0.200' => '5', '0.166' => '6', '0.142' => '7', '0.125' => '8', '0.111' => '9'];
            PerbandinganKriteria::updateOrCreate([
                'kriteria_id1' => $reqId2s[$i],
                'kriteria_id2' => $reqId1s[$i],
            ], ['nilai' => array_key_exists($nilai, $kebalikan) ? (double) $kebalikan[$nilai] : 1 / (double) $nilai]);

            // simpan nilai perbandingan kriteria A dengan A (Dengan dirinya sendiri)
            // 1 - 2
            // 1 - 3
            // 2 - 3
            PerbandinganKriteria::updateOrCreate([
                'kriteria_id1' => $reqId1s[$i],
                'kriteria_id2' => $reqId1s[$i],
            ], ['nilai' => (double) 1]);

            // simpan nilai perbandingan kriteria B dengan B (Dengan dirinya sendiri)
            PerbandinganKriteria::updateOrCreate([
                'kriteria_id1' => $reqId2s[$i],
                'kriteria_id2' => $reqId2s[$i],
            ], ['nilai' => (double) 1]);

            $i++;
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
