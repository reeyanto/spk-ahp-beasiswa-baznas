@extends('admin.template')

@section('content')
    <h1 class="h3 mb-3">Dashboard</h1>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card bg-primary">
                <div class="card-body">
                    <p class="text-light">Periode</p>
                    <p class="h1 text-light fw-bold">{{ $periode }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card bg-success">
                <div class="card-body">
                    <p class="text-light">Kriteria</p>
                    <p class="h1 text-light fw-bold">{{ $kriteria }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card bg-warning">
                <div class="card-body">
                    <p class="text-light">Sub Kriteria</p>
                    <p class="h1 text-light fw-bold">{{ $subkriteria }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card bg-danger">
                <div class="card-body">
                    <p class="text-light">Alternatif</p>
                    <p class="h1 text-light fw-bold">{{ $alternatif }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <h3>Aplikasi Penentuan Penerima Beasiswa BAZNAS Kabupaten Pelalawan Menggunakan Metode Analytics Hierarchy Process (AHP)</h3>
                    <p class="mt-4" style="text-align:justify">AHP merupakan suatu model pendukung keputusan yang dikembangkan oleh Thomas L. Saaty. Model pendukung keputusan ini akan menguraikan masalah multi faktor atau multi kriteria yang kompleks menjadi suatu hirarki, menurut Saaty (1993), hirarki didefinisikan sebagai suatu representasi dari sebuah permasalahan yang kompleks dalam suatu struktur multi-level dimana level pertama adalah tujuan, yang diikuti level faktor, kriteria, sub kriteria, dan seterusnya ke bawah hingga level terakhir dari alternatif. Dengan hirarki, suatu masalah yang kompleks dapat diuraikan ke dalam kelompok-kelompoknya yang kemudian diatur menjadi suatu bentuk hirarki sehingga permasalahan akan tampak lebih terstruktur dan sistematis  (Syaifullah, 2010).</p>
                </div>
            </div>
        </div>
    </div>
@endsection