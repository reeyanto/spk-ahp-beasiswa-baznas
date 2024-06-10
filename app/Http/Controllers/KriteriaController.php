<?php

namespace App\Http\Controllers;

use App\Http\Requests\KriteriaRequest;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('admin.kriteria.index', compact('kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KriteriaRequest $request)
    {
        $simpan = Kriteria::create($request->validated());

        if($simpan) {
            return redirect()->route('kriteria.index')->with('success', 'Data berhasil disimpan');
        }
        return redirect()->back()->withErrors('Data gagal disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriteria)
    {
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KriteriaRequest $request, Kriteria $kriteria)
    {
        $update = $kriteria->update($request->validated());

        if($update) {
            return redirect()->route('kriteria.index')->with('success', 'Data berhasil diperbarui');
        }
        return redirect()->back()->withErrors('Data gagal diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriteria)
    {
        $hapus = $kriteria->delete();

        if($hapus) {
            return redirect()->route('kriteria.index')->with('success', 'Data berhasil dihapus');
        }
        return redirect()->back()->withErrors('Data gagal dihapus');
    }
}
