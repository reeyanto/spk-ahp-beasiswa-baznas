@extends('admin.template')

@section('content')
    <h1 class="h3 mb-3">Data Sub Kriteria</h1>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header bg-info">
                    <a href="{{ route('subkriteria.create') }}" class="btn btn-sm btn-primary">
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
                            <th>Sub Kriteria</th>
                            <th>Keterangan</th>
                            <th>Opsi</th>
                        </thead>
                        <tbody>
                            @foreach ($subkriteria as $sub)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="badge badge-primary">{{ $sub->kriteria->kode }}</span> {{ $sub->kriteria->nama }}</td>
                                    <td><span class="badge badge-success">{{ $sub->kode }}</span> {{ $sub->nama }}</td>
                                    <td>{{ $sub->keterangan }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Yakin ingin menghapus data ini?')" action="{{ route('subkriteria.destroy', $sub->id) }}" method="post">
                                            <a href="{{ route('subkriteria.edit', $sub->id) }}" class="btn btn-sm btn-warning">
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