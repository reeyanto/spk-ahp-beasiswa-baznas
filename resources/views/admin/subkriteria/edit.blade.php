@extends('admin.template')

@section('content')
    <h1 class="h3 mb-3">Data Sub Kriteria</h1>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header bg-info">
                    <a href="{{ route('subkriteria.index') }}" class="btn btn-sm btn-warning">
                        <i class="align-middle" data-feather="chevron-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('subkriteria.update', $subkriteria->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="Nama Kriteria" class="form-label">Nama Kriteria <span class="text text-danger">*</span></label>
                            <select name="kriteria_id" id="kriteria_id" class="form-control @error('kriteria_id') is-invalid @enderror">
                                @foreach($kriterias as $kriteria)
                                <option value="{{ $kriteria->id }}" {{ ($kriteria->id == $subkriteria->kriteria_id) ? 'selected': ''}}>{{ $kriteria->nama }}</option>
                                @endforeach
                            </select>
                            @error('kriteria_id')
                            <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Sub Kriteria <span class="text text-danger">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $subkriteria->nama) }}">
                            @error('nama')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Keterangan" style="resize:none">{{ old('keterangan', $subkriteria->keterangan) }}</textarea>
                            @error('keterangan')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="align-middle" data-feather="save"></i> Simpan
                            </button>
                            <button type="reset" class="btn btn-sm btn-warning">
                                <i class="align-middle" data-feather="slash"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection