@extends('admin.template')

@section('content')
    <h1 class="h3 mb-3">Perbandingan Kriteria</h1>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    @if (session('success'))
                        <p class="alert alert-success" id="alert">{{ session('success') }}</p>
                    @endif
                    <p class="alert bg-light">
                        <i class="align-middle" data-feather="check-circle"></i>
                        Tentukan <strong>Skala Kepentingan</strong> dari masing-masing kriteria
                    </p>
                   <form action="{{ route('perbandingan-kriteria.store') }}" method="post" class="mt-3">
                        @csrf
                        <table class="table table-sm table-striped table-hover">
                            <thead>
                                <th>Nama Kriteria</th>
                                <th>Skala Kepentingan</th>
                                <th>Nama Kriteria</th>
                            </thead>
                            <tbody>
                                @foreach ($perbandingan as $index => $pk)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="id1[{{ $index }}]" value="{{ $pk->id1 }}">
                                            <input type="text" name="nama1[{{ $index }}]" id="nama1[{{ $index }}]" class="form-control" value="[{{ $pk->kode1 . '] ' . $pk->nama1 }}" disabled>
                                        </td>
                                        <td>
                                            <select name="nilai[{{ $index }}]" id="nilai[{{ $index }}]" class="form-control @error('nilai.'. $index) is-invalid @enderror">
                                                <option value="0" selected>Pilih Nilai Perbandingan</option>
                                                @foreach(['9.000' => '9', '8.000' => '8', '7.000' => '7', '6.000' => '6', '5.000' => '5', '4.000' => '4', '3.000' => '3', '2.000' => '2', '1.000' => '1', '0.500' => '1/2', '0.333' => '1/3', '0.250' => '1/4', '0.200' => '1/5', '0.166' => '1/6', '0.142' => '1/7', '0.125' => '1/8', '0.111' => '1/9'] as $index_nilai => $label)
                                                    <option value="{{ $index_nilai }}" {{ ((old('nilai.'. $index) == $index_nilai) || ($pk->nilai == $index_nilai)) ? 'selected': '' }}>{{ $label }}x lebih penting dari</option>
                                                @endforeach
                                            </select>
                                            @error('nilai.'. $index)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="hidden" name="id2[{{ $index }}]" value="{{ $pk->id2 }}">
                                            <input type="text" name="nama2[{{ $index }}]" id="nama2[{{ $index }}]" class="form-control" value="[{{ $pk->kode2 . '] ' . $pk->nama2 }}" disabled>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mb-3 d-grid">
                            <button type="submit" name="submit" class="btn btn-sm btn-primary">
                                <i class="align-middle" data-feather="save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h2 class="h3 mb-3">Matriks Perbandingan Kriteria</h2>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <table class="table table-sm table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                @foreach ($kriteria as $k)
                                    <th>{{ $k->kode }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matrix as $k1 => $row)
                                <tr>
                                    <th>{{ $k1 }}</th>
                                    @foreach ($row as $k2 => $nilai)
                                        <td>{{ $nilai }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                            <tr class="table-primary">
                                <th>Jumlah</th>
                                @foreach ($totals as $total)
                                    <th>{{ $total }}</th>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>

    <h2 class="h3 mb-3">Matriks Nilai Kriteria (Normalisasi)</h2>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <table class="table table-sm table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                @foreach ($kriteria as $k)
                                    <th>{{ $k->kode }}</th>
                                @endforeach
                                <th class="table-primary">Jumlah</th>
                                <th class="table-primary">Prioritas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($normalized_matrix as $k1 => $row)
                                <tr>
                                    <th>{{ $k1 }}</th>
                                    @foreach ($row as $nilai)
                                        <td>{{ is_numeric($nilai) ? number_format($nilai, 3) : $nilai }}</td>
                                    @endforeach
                                    <td class="table-primary">{{ number_format($jumlah_per_baris[$k1], 3) }}</td>
                                    <td class="table-primary">{{ number_format($prioritas_per_baris[$k1], 3) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>

    <h2 class="h3 mb-3">Matriks Penjumlahan Setiap Baris</h2>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <table class="table table-sm table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                @foreach ($kriteria as $k)
                                    <th>{{ $k->kode }}</th>
                                @endforeach
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($matrix_penjumlahan as $baris_kode => $kolom)
                                <tr>
                                    <th>{{ $baris_kode }}</th>
                                    @foreach ($kolom as $nilai)
                                        <td>{{ number_format($nilai, 4) }}</td>
                                    @endforeach
                                    <td>{{ number_format($jumlah_penjumlahan_per_baris[$baris_kode] ?? 0, 4) }}</td>
                                </tr>
                            @endforeach --}}

                            @foreach ($matrix as $k1 => $row)
                                <tr>
                                    <th>{{ $k1 }}</th>
                                    @foreach ($row as $k2 => $nilai)
                                        <td>{{ 'a' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>


    <h2 class="h3 mb-3">Rasio Konsistensi</h2>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                     {{ number_format($cr, 4) }}
                </div>
            </div>
        </div>
    </div>

@endsection