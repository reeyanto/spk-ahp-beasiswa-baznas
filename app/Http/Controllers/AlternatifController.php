<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlternatifRequest;
use App\Models\Alternatif;
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
}
