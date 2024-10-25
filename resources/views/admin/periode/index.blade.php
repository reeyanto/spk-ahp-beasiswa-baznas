@extends('admin.template')

@section('content')
    <h1 class="h3 mb-3">Data Periode</h1>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header bg-info">
                    <a href="{{ route('periode.create') }}" class="btn btn-sm btn-primary">
                        <i class="align-middle" data-feather="plus"></i> Tambah Data
                    </a>
                </div>
                <div class="card-body table-responsive">
                    @if (session('success'))
                        <p class="alert alert-success" id="alert">{{ session('success') }}</p>
                    @endif
                    <table class="table table-sm table-striped table-hover" id="datatable">
                        <thead>
                            <th>No.</th>
                            <th>Nama Periode</th>
                            <th>Tahun</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($periodes as $periode)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $periode->nama }}</td>
                                    <td><span class="badge badge-primary">{{ $periode->tahun }}</span></td>
                                    <td>{{ $periode->keterangan }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('periode.edit', $periode->id) }}" class="dropdown-item">
                                                        <i class="align-middle" data-feather="edit"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form onsubmit="return confirm('Yakin ingin menghapus data ini?')" action="{{ route('periode.destroy', $periode->id) }}" method="post">
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