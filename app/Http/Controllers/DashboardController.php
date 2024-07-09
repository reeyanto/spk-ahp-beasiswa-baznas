<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Periode;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $periode = Periode::count();
        $kriteria = Kriteria::count();
        $subkriteria = SubKriteria::count();
        $alternatif = Alternatif::count();

        return view('admin.dashboard.index', compact('periode', 'kriteria', 'subkriteria', 'alternatif'));
    }
}
