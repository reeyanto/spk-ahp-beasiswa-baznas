<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlternatifKriteriaRequest;
use App\Http\Requests\AlternatifRequest;
use App\Models\Alternatif;
use App\Models\AlternatifKriteria;
use App\Models\Kriteria;
use App\Models\Periode;
use Illuminate\Http\Request;

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
        //$alternatifId = $alternatif->id;

        $kriteria = Kriteria::leftJoin('alternatif_kriteria', function($join) use ($alternatif) {
                $join->on('kriteria.id', '=', 'alternatif_kriteria.kriteria_id')
                    ->where('alternatif_kriteria.alternatif_id', '=', $alternatif->id);
            })
            ->select('kriteria.id as kriteria_id', 'kriteria.nama as kriteria_nama', 'alternatif_kriteria.nilai as nilai')
            ->get();

        return view('admin.alternatif.kriteria', compact('kriteria'));
    }


    public function kriteria_store(AlternatifKriteriaRequest $request) {
        $alternatifId = $request->input('alternatif_id');
        $kriteriaData = $request->input('kriteria_id');

        $alternatifKriteria = null;

        foreach($kriteriaData as $kriteriaId => $nilai) {
            $alternatifKriteria = AlternatifKriteria::updateOrCreate([
                    'alternatif_id' => $alternatifId,
                    'kriteria_id' => $kriteriaId,
            ],
            ['nilai' => $nilai]);
        }

        if($alternatifKriteria != null) {
            return redirect()->route('alternatif.index')->with('success', 'Data berhasil disimpan');
        }
        return redirect()->route('alternatif.index')->with('error', 'Data gagal disimpan');
    }

}
