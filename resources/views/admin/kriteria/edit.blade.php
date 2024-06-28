@extends('admin.template')

@section('content')
    <h1 class="h3 mb-3">Data Kriteria</h1>
    <div class="row">
        <div class="col-12 col-lg-8 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header bg-info">
                    <a href="{{ route('kriteria.index') }}" class="btn btn-sm btn-warning">
                        <i class="align-middle" data-feather="chevron-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('kriteria.update', $kriteria->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="Nama Kriteria" class="form-label">Nama Kriteria <span class="text text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Kriteria" value="{{ old('nama', $kriteria->nama) }}" />
                            @error('nama')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" cols="30" rows="4" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan" style="resize:none;">{{ old('keterangan', $kriteria->keterangan) }}</textarea>
                            @error('keterangan')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="align-middle" data-feather="save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection