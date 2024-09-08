@extends('admin.template')

@section('content')
    <h1 class="h3 mb-3">Data Kriteria Alternatif</h1>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header bg-info">
                    <a href="{{ route('alternatif.index') }}" class="btn btn-sm btn-warning">
                        <i class="align-middle" data-feather="chevron-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('alternatif.kriteria.store') }}" method="post">
                        @csrf

                        <input type="hidden" name="alternatif_id" value="{{ request()->segment(4) }}">

                        @foreach($kriteria as $k)
                            <div class="mb-3">
                                <label class="form-label">{{ $k->nama_kriteria }} <span class="text text-danger">*</span></label>
                                
                                <input type="hidden" name="kriteria_id[]" value="{{ $k->id }}">
                                
                                <select name="subkriteria_id[{{ $k->id }}]" class="form-control @error('subkriteria_id.'. $k->id) is-invalid @enderror">
                                    @php
                                        $subkriteria_ids    = explode(',', $k->subkriteria_id);
                                        $subkriteria_namas  = explode(',', $k->subkriteria_nama);
                                        @endphp
                                    <option value=""></option>
                                    @foreach($subkriteria_ids as $index => $subkriteria_id)
                                        <option value="{{ $subkriteria_id }}" {{ old('subkriteria_id.'. $k->id, $k->subkriteria_id) == $subkriteria_id ? 'selected' : '' }}>
                                            {{ $subkriteria_namas[$index] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subkriteria_id.'. $k->id)
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-sm">
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