@extends('admin.template')

@section('content')
    <h1 class="h3 mb-3">Dashboard</h1>
    <div class="row">
        <div class="col-12 col-lg-8 col-xxl-12 d-flex">
            <div class="card flex-fill">
                @if (session('success'))
                    <div class="card-header bg-secondary text-white">{{ session('success') }}</div>
                @endif
                <div class="card-body">
                    <h1>Sistem Pendukung Keputusan</h1>
                    <h4>Penentuan Penerima Beasiswa BAZNAS Kabupaten Pelalawan Menggunakan Metode Analytics Hierarchy Process (AHP)</h4>
                </div>
            </div>
        </div>
    </div>
@endsection