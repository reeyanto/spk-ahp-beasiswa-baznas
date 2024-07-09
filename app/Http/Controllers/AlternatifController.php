<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlternatifKriteriaRequest;
use App\Http\Requests\AlternatifRequest;
use App\Models\Alternatif;
use App\Models\AlternatifKriteria;
use App\Models\Kriteria;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alternatifs = Alternatif::all();
        return view('admin.alternatif.index', compact('alternatifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periodes = Periode::all();
        return view('admin.alternatif.create', compact('periodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlternatifRequest $request)
    {
        $simpan = Alternatif::create($request->validated());

        if($simpan) {
            return redirect()->route('alternatif.index')->with('success', 'Data berhasil disimpan');
        }
        return redirect()->back()->withErrors('Data gagal disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alternatif $alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alternatif $alternatif)
    {
        $periodes = Periode::all();
        return view('admin.alternatif.edit', compact('alternatif', 'periodes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlternatifRequest $request, Alternatif $alternatif)
    {
        $update = $alternatif->update($request->validated());

        if($update) {
            return redirect()->route('alternatif.index')->with('success', 'Data berhasil diperbarui');
        }
        return redirect()->back()->withErrors('Data gagal diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternatif $alternatif)
    {
        $hapus = $alternatif->delete();

        if($hapus) {
            return redirect()->route('alternatif.index')->with('success', 'Data berhasil dihapus');
        }
        return redirect()->back()->withErrors('Data gagal dihapus');
    }


    public function kriteria(Alternatif $alternatif) {
        $kriteria = collect(DB::select(
            'select k.id, k.nama as nama_kriteria, group_concat(s.id) as subkriteria_id, group_concat(s.nama) as subkriteria_nama
             from kriteria k
             left join sub_kriteria s
             on k.id = s.kriteria_id
             group by k.id, k.nama'
        ));

        return view('admin.alternatif.kriteria', compact('kriteria'));
    }


    public function kriteria_store(AlternatifKriteriaRequest $request) {
        // Loop melalui setiap kriteria yang dikirimkan dari form
        foreach ($request->kriteria_id as $kriteriaId) {
            $subkriteriaId = $request->subkriteria_id[$kriteriaId];
            
            // Menggunakan updateOrCreate untuk menyimpan atau update ke database
            $alternatifKriteria = AlternatifKriteria::updateOrCreate(
                [
                    'alternatif_id' => $request->alternatif_id,
                    'kriteria_id'   => $kriteriaId
                ],
                ['subkriteria_id' => $subkriteriaId]
            );
        }

        if($alternatifKriteria != null) {
            return redirect()->route('alternatif.index')->with('success', 'Data berhasil disimpan');
        }
        return redirect()->route('alternatif.index')->with('error', 'Data gagal disimpan');
    }

}
