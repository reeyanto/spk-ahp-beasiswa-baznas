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
                    <h4 mt-4>Penentuan Penerima Beasiswa BAZNAS Kabupaten Pelalawan Menggunakan Metode Analytics Hierarchy Process (AHP)</h4>

                    <p class="mt-4" style="text-align:justify">AHP merupakan suatu model pendukung keputusan yang dikembangkan oleh Thomas L. Saaty. Model pendukung keputusan ini akan menguraikan masalah multi faktor atau multi kriteria yang kompleks menjadi suatu hirarki, menurut Saaty (1993), hirarki didefinisikan sebagai suatu representasi dari sebuah permasalahan yang kompleks dalam suatu struktur multi-level dimana level pertama adalah tujuan, yang diikuti level faktor, kriteria, sub kriteria, dan seterusnya ke bawah hingga level terakhir dari alternatif. Dengan hirarki, suatu masalah yang kompleks dapat diuraikan ke dalam kelompok-kelompoknya yang kemudian diatur menjadi suatu bentuk hirarki sehingga permasalahan akan tampak lebih terstruktur dan sistematis  (Syaifullah, 2010).</p>
                </div>
            </div>
        </div>
    </div>
@endsection