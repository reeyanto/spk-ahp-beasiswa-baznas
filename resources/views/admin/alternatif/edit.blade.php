@extends('admin.template')

@section('content')
    <h1 class="h3 mb-3">Data Alternatif</h1>
    <div class="row">
        <div class="col-12 col-lg-8 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header bg-info">
                    <a href="{{ route('alternatif.index') }}" class="btn btn-sm btn-warning">
                        <i class="align-middle" data-feather="chevron-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('alternatif.update', $alternatif->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="periode" class="form-label">Periode</label>
                            <select name="periode_id" class="form-control">
                                @foreach ($periodes as $periode)
                                    <option value="{{ old('periode_id', $periode->id) }}" {{ old('periode_id', $periode->id) == $alternatif->periode->id ? 'selected' : ''}}>{{ $periode->tahun . " | " . $periode->nama }}</option>
                                @endforeach
                            </select>
                            @error('periode_id')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Nama Lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('nama', $alternatif->nama) }}" />
                            @error('nama')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" cols="30" rows="4" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat" style="resize:none;">{{ old('alamat', $alternatif->alamat) }}</textarea>
                            @error('alamat')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Jenis Kelamin" class="form-label">Jenis Kelamin</label>
                            <select name="jk" class="form-control @error('jk') is-invalid @enderror">
                                <option value="{{ old('jk', 'L') }}" {{ old('jk', $alternatif->jk) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="{{ old('jk', 'P') }}" {{ old('jk', $alternatif->jk) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jk')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="HP" class="form-label">HP</label>
                            <input type="text" name="hp" class="form-control @error('hp') is-invalid @enderror" placeholder="Nomor HP" value="{{ old('hp', $alternatif->hp) }}" />
                            @error('hp')
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