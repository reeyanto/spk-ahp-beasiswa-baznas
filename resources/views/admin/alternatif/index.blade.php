@extends('admin.template')

@section('content')
    <h1 class="h3 mb-3">Data Alternatif</h1>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header bg-info">
                    <a href="{{ route('alternatif.create') }}" class="btn btn-sm btn-primary">
                        <i class="align-middle" data-feather="plus"></i> Tambah Data
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <p class="alert alert-success" id="alert">{{ session('success') }}</p>
                    @endif
                    <table class="table table-sm table-striped table-hover" id="datatable">
                        <thead>
                            <th>No.</th>
                            <th>Periode</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>HP</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($alternatifs as $alternatif)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="badge badge-primary">{{ $alternatif->periode->tahun}}</span> {{ $alternatif->periode->nama }}</td>
                                    <td>{{ $alternatif->nama }}</td>
                                    <td>{{ $alternatif->alamat }}</td>
                                    <td>{{ $alternatif->hp }}</td>
                                    <td>{{ $alternatif->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('alternatif.kriteria', $alternatif->id) }}" class="dropdown-item">
                                                        <i class="align-middle" data-feather="eye"></i> Kriteria
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('alternatif.edit', $alternatif->id) }}" class="dropdown-item">
                                                        <i class="align-middle" data-feather="edit"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form onsubmit="return confirm('Yakin ingin menghapus data ini?')" action="{{ route('alternatif.destroy', $alternatif->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="align-middle" data-feather="trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection