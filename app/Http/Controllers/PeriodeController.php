<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use App\Http\Requests\PeriodeRequest;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodes = Periode::all();
        return view('admin.periode.index', compact('periodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.periode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PeriodeRequest $request)
    {
        $simpan = Periode::create($request->validated());

        if($simpan) {
            return redirect()->route('periode.index')->with('success', 'Data berhasil disimpan');
        }
        return redirect()->back()->withErrors('Data gagal disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Periode $periode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periode $periode)
    {
        return view('admin.periode.edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PeriodeRequest $request, Periode $periode)
    {
        $update = $periode->update($request->validated());

        if($update) {
            return redirect()->route('periode.index')->with('success', 'Data berhasil diperbarui');
        }
        return redirect()->back()->withErrors('Data gagal diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periode $periode)
    {
        $hapus = $periode->delete();

        if($hapus) {
            return redirect()->route('periode.index')->with('success', 'Data berhasil dihapus');
        }
        return redirect()->back()->withErrors('Data gagal dihapus');
    }
}
