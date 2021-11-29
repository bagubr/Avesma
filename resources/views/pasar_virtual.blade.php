@extends('layouts.app')
@push('css')
<style>
    .carousel-inner,
    .carousel {
        height: 500px;
    }

    .carousel-item img,
    .img-carousel {
        width: 100%;
        height: 500px;
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
        max-height: 100px;
        object-fit: cover;
    }

    img.ikan.rounded-circle {
        object-fit: cover;
    }

    .filter_ikan {
        filter: drop-shadow(-7px 4px 14px #2689DA);
    }

    .btn-cari {
        width: 7rem;
    }
</style>
@endpush
@section('content')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php $pos=0 ?>
        @foreach ($sliders as $slider)
        <?php $pos++ ?>
        @if ($pos == 1)
        <div class="carousel-item active">
            @else
            <div class="carousel-item">
                @endif
                <div class="w-100 parallax" style="background-image: url({{$slider->image_url}})"></div>
            </div>
            @endforeach
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
    <div id="app">
        <section class="pasar-virtual">
            <div class="container">
                <div class="text-center mt-5">
                    <h1 class="font-weight-bold">Pasar Virtual</h1>
                    <div class="row mt-4">
                        @foreach ($fish_categories as $fish_category)
                        <div class="col-md-4">
                            <img src="{{$fish_category->image_url}}" class="ikan rounded-circle"
                                :class="{ 'filter_ikan': fish_category_id == {{$fish_category->id}} }" width="150rem"
                                height="150rem" @click="fish_category_id = {{$fish_category->id}}">
                            <h4 class="font-weight-bold mt-4">{{$fish_category->name}}</h4>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <section class="pasar my-5">
            <div class="container">
                <div class="form-row mt-4">
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control font-weight-bold" v-model="fish_name"
                            placeholder="Cari Spesies">
                    </div>
                    <div class="col-md-6 form-group">
                        <select class="form-control font-weight-bold" v-model="region_id">
                            <option value="">Pilih Area</option>
                            @foreach ($regions as $region)
                            <option value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary font-weight-bold rounded-custom btn-cari" @click="getMarkets">
                        <i class="fas fa-search"></i>
                        Cari
                    </button>
                </div>
                <div class="row mt-5">
                    <div class="spinner-border" role="status" v-if="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="col-6 col-md-3 mb-4" v-else v-for="market in markets">
                        <div class="card w-100 bg-blue">
                            <img class="card-img-top" :src="market.pond_detail.fish_species_image">
                            <div class="card-body">
                                <h5 class="card-title text-center">
                                    @{{market.pond_detail.spesies_name}}
                                </h5>
                                <p class="card-text">@{{market.region_name}}
                                    @{{market.pond_detail.fish_category}}
                                </p>
                                <div class="text-center">
                                    <a :href="'/pasar_virtual/' + market.id"
                                        class="btn btn-light font-weight-bold rounded-custom w-75">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endsection
    @section('imagefooter')
    <img class="w-100" src="{{asset('asset/footer-image.png')}}" />
    @endsection
    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{asset('js/pasar_virtual.js')}}">
    </script>
    @endpush