@extends('admin.template')

@section('content')
    <h1 class="h3 mb-3">Data Kriteria</h1>
    <div class="row">
        <div class="col-12 col-lg-8 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header bg-info">
                    <a href="{{ route('kriteria.create') }}" class="btn btn-sm btn-primary">
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
                            <th>Nama Kriteria</th>
                            <th>Keterangan</th>
                            <th>Opsi</th>
                        </thead>
                        <tbody>
                            @foreach ($kriterias as $kriteria)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kriteria->nama }}</td>
                                    <td>{{ $kriteria->keterangan }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Yakin ingin menghapus data ini?')" action="{{ route('kriteria.destroy', $kriteria->id) }}" method="post">
                                            <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="btn btn-sm btn-warning">
                                                <i class="align-middle" data-feather="edit"></i> Edit
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="align-middle" data-feather="trash"></i> Hapus
                                            </button>
                                        </form>
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