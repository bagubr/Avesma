@extends('layouts.app')
@push('css')
<style>
    .carousel-inner {
        height: 500 px;
    }

    .carousel-item img {
        height: 500 px;
        object-fit: cover;
    }

    .form-control::placeholder {
        color: black;
        opacity: 1;
    }

    .form-control:-ms-input-placeholder {
        color: black;
    }

    .form-control::-ms-input-placeholder {
        color: black;
    }

    input {
        color: black
    }

    .parallax {
        min-height: 500px;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .card {
        border-radius: 30px;
    }

    img.card-img-top {
        border-radius: 30px;
    }

    img.ikan.rounded-circle {
        object-fit: cover;
    }
</style>
@endpush
@section('content')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="w-100 parallax" style="background-image: url({{asset('asset/image-2.jpg')}})"></div>
        </div>
        <div class="carousel-item">
            <div class="w-100 parallax" style="background-image: url({{asset('asset/1.jpg')}})"></div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<section class="pasar-virtual">
    <div class="container">
        <div class="text-center mt-5">
            <h1 class="font-weight-bold">Pasar Virtual</h1>
            <div class="row mt-4">
                <div class="col-4">
                    <img src="{{asset('asset/image-2.jpg')}}" class="ikan rounded-circle"
                        style="filter: drop-shadow(-8px 9px 27px #2689DA);" width="150rem" height="150rem">
                    <h4 class="font-weight-bold mt-4">Air Tawar</h4>
                </div>
                <div class="col-4">
                    <img src="{{asset('asset/1.jpg')}}" class="ikan rounded-circle"
                        style="filter: drop-shadow(-8px 9px 27px #2689DA);" width="150rem" height="150rem">
                    <h4 class="font-weight-bold mt-4">Air Tawar</h4>
                </div>
                <div class="col-4">
                    <img src="{{asset('asset/fakta-ikan-nila-2_169.jpeg')}}" class="ikan rounded-circle"
                        style="filter: drop-shadow(-8px 9px 27px #2689DA);" width="150rem" height="150rem">
                    <h4 class="font-weight-bold mt-4">Air Tawar</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pasar my-5">
    <div class="container">
        <div class="form-row mt-4">
            <div class="col-md-6 form-group">
                <input type="text" class="form-control font-weight-bold" placeholder="Cari Spesies">
            </div>
            <div class="col-md-6 form-group">
                <input type="text" class="form-control font-weight-bold" placeholder="Pilih Wilayah">
            </div>
        </div>
        <div class="text-right">
            <button class="btn btn-primary">Cari</button>
        </div>
        <div class="row mt-5">
            <div class="col-6 col-md-3 mb-4">
                <div class="card w-100 bg-blue">
                    <img class="card-img-top" src="{{asset('asset/image-2.jpg')}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title text-center">Ikan Nila</h5>
                        <p class="card-text">Nama Petani / Area</p>
                        <p class="card-text">10/Kg</p>
                        <div class="text-center">
                            <a href="#" class="btn btn-light font-weight-bold rounded-custom w-75">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('imagefooter')
<img class="w-100" src="{{asset('asset/footer-image.png')}}" />
@endsection