@extends('admin.template')

@section('content')
    <h1 class="h3 mb-3">Data Periode</h1>
    <div class="row">
        <div class="col-12 col-lg-8 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header bg-info">
                    <a href="{{ route('periode.index') }}" class="btn btn-sm btn-warning">
                        <i class="align-middle" data-feather="chevron-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('periode.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="Nama Periode" class="form-label">Nama Periode <span class="text text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Priode" value="{{ old('nama') }}" />
                            @error('nama')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Tahun" class="form-label">Tahun <span class="text text-danger">*</span></label>
                            <select name="tahun" class="form-control @error('tahun') is-invalid @enderror">
                                <?php for($tahun = 2021; $tahun <= date('Y'); $tahun++): ?>
                                    <option value="{{ $tahun }}" {{ old('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                <?php endfor; ?>
                            </select>
                            @error('tahun')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Keterangan" style="resize:none">{{ old('keterangan') }}</textarea>
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