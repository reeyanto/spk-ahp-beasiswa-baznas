<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use App\Http\Requests\SubKriteriaRequest;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subkriteria = SubKriteria::all();
        return view('admin.subkriteria.index', compact('subkriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriterias = Kriteria::all();
        return view('admin.subkriteria.create', compact('kriterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubKriteriaRequest $request)
    {
        $simpan = SubKriteria::create($request->validated());

        if($simpan) {
            return redirect()->route('subkriteria.index')->with('success', 'Data berhasil disimpan');
        }
        return redirect()->back()->withErrors('Data gagal disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubKriteria $subkriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubKriteria $subkriteria)
    {
        $kriterias = Kriteria::all();
        return view('admin.subkriteria.edit', compact('kriterias', 'subkriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubKriteriaRequest $request, SubKriteria $subkriteria)
    {
        $update = $subkriteria->update($request->validated());

        if($update) {
            return redirect()->route('subkriteria.index')->with('success', 'Data berhasil diperbarui');
        }
        return redirect()->back()->withErrors('Data gagal diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubKriteria $subkriteria)
    {
        $hapus = $subkriteria->delete();

        if($hapus) {
            return redirect()->route('subkriteria.index')->with('success', 'Data berhasil dihapus');
        }
        return redirect()->back()->withErrors('Data gagal dihapus');
    }
}
