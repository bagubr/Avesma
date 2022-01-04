@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{asset('dist/magnific-popup.css')}}">
<style>
    img.fish-detail {
        width: 15rem;
        height: 15rem;
        object-fit: cover;
        object-position: center;
    }
</style>
@endpush
@section('content')
test
<section class="detail_pasar_virtual mt-5">
    <div class="container">
        <h2 class="font-weight-bold text-center">Artikel Umum Terbaru</h2>
        <div class="row mt-5 mx-auto">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{asset('asset/screenshot_5.png')}}" class="img-fluid" alt="">
                </div>
                <div class="col-md-8">
                    <h5 class="font-weight-bold">Probiotik sebagai Solusi Pengendalian Penyakit dan Peningkatan
                        Produksi
                        pada Budidaya Ikan Lele</h5>
                    <p class="font-weight-bold">Berita / Dipublikasikan 08-11-2021</p>
                    <p>Salah satu usaha budidaya yang banyak dilakukan masayarakat indonesia adalah budidaya ikan
                        konsumsi air tawar yaitu ikan lele</p>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-2 mt-1"> <img src="{{asset('asset/screenshot_5.png')}}" class="h-100 img-fluid" alt="">
            </div>
            <div class="col-md-4 mt-1">
                <h5 class="font-weight-bold">Probiotik sebagai Solusi Pengendalian Penyakit dan Peningkatan
                    Produksi
                    pada Budidaya Ikan Lele</h5>
                <p class="font-weight-bold">Berita / Dipublikasikan 08-11-2021</p>
            </div>
            <div class="col-md-2 mt-1"> <img src="{{asset('asset/screenshot_5.png')}}" class="h-100 img-fluid" alt="">
            </div>
            <div class="col-md-4 mt-1">
                <h5 class="font-weight-bold">Probiotik sebagai Solusi Pengendalian Penyakit dan Peningkatan
                    Produksi
                    pada Budidaya Ikan Lele</h5>
                <p class="font-weight-bold">Berita / Dipublikasikan 08-11-2021</p>
            </div>
            <div class="col-md-2 mt-1"> <img src="{{asset('asset/screenshot_5.png')}}" class="h-100 img-fluid" alt="">
            </div>
            <div class="col-md-4 mt-1">
                <h5 class="font-weight-bold">Probiotik sebagai Solusi Pengendalian Penyakit dan Peningkatan
                    Produksi
                    pada Budidaya Ikan Lele</h5>
                <p class="font-weight-bold">Berita / Dipublikasikan 08-11-2021</p>
            </div>
            <div class="col-md-2 mt-1"> <img src="{{asset('asset/screenshot_5.png')}}" class="h-100 img-fluid" alt="">
            </div>
            <div class="col-md-4 mt-1">
                <h5 class="font-weight-bold">Probiotik sebagai Solusi Pengendalian Penyakit dan Peningkatan
                    Produksi
                    pada Budidaya Ikan Lele</h5>
                <p class="font-weight-bold">Berita / Dipublikasikan 08-11-2021</p>
            </div>
        </div>
    </div>
</section>
@endsection