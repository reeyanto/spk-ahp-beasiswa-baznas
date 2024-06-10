@extends('admin.template')

@section('content')
    <h1 class="h3 mb-3">Password</h1>
    <div class="row">
        <div class="col-12 col-lg-8 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header bg-danger">
                    <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-warning">
                        <i class="align-middle" data-feather="chevron-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <p class="alert alert-success" id="alert">{{ session('success') }}</p>
                    @endif
                    <form action="{{ route('password.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="Password Baru" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password Baru">
                            @error('password')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Password Baru" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Konfirmasi Password Baru">
                            @error('password_confirmation')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="submit" class="btn btn-sm btn-primary">
                                <i class="align-middle" data-feather="lock"></i>
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection