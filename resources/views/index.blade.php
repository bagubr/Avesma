@extends('layouts.app')
@push('css')
<style>
    .carousel-cell {
        width: 100%;
        margin-right: 16px;
    }

    .slider-img img {
        height: 500px;
        object-fit: cover;
        object-position: center;
    }

    @media (min-width: 768px) {
        .slider-img img {
            border-radius: 0 0 0 25px;
        }
    }

    .flickity-page-dots {
        bottom: 10px;
    }

    .flickity-page-dots .dot {
        background: #2689da;
    }

    .img-kenapa img {
        height: 100px;
        max-width: 100%;
    }
/* 
    .visi-misi {
        background-image: url('{{asset('asset/bg-avesma-motif-03-03.png')}}'),
        #6DB3F2;
    } */
</style>
@endpush
@section('content')
<section class="hero">
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-md-1"></div>
            <div class="col-md-5 order-2 order-md-1 my-auto">
                <h1 class="font-weight-bold">AVESMA</h1>
                <p>
                    AVESMA merupakan aplikasi handphone yang dibuat bagi pembudidaya
                    ikan untuk memberikan informasi cara budidaya ikan yang baik
                    berdasarkan aturan SNI. Aplikasi ini diwujudkan untuk membantu
                    pernyuluh yang jumlahnya masih sangat kurang di Indonesia sehingga
                    tidak dapat secara maksimal membantu pembudidaya di lapangan.
                </p>
                <div class="text-center">
                    <img src="{{asset('asset/playstore.png')}}" class="img-fluid" style="height: 4em" />
                </div>
            </div>
            <div class="col-md-6 order-1 order-md-2 px-0">
                <div class="main-carousel" data-flickity='{ "contain": true,"pageDots": false,"wrapAround": true }'>
                    @foreach ($sliders as $slider)
                    <div class="carousel-cell slider-img">
                        <img src="{{$slider->image_url}}" class="w-100" />
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tentang-kita mt-5">
    <div class="container">
        <div class="row h-100">
            <div class="col-md-6">
                <div class="embed-responsive embed-responsive-16by9 h-100">
                    <iframe class="embed-responsive-item" src="{{$about->video_url ?? "
                        https://www.youtube.com/embed/QggJzZdIYPI"}}" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-right">
                <h2 class="font-weight-bold">Tentang Kita</h2>
                <div class="main-carousel pb-3" data-flickity='{ "prevNextButtons": false }'>
                    <div class="text-justify carousel-cell">
                        {!!$about->description_indo ?? "Belum Ada Data Dimasukkan"!!}
                    </div>
                    <div class="text-justify carousel-cell">
                        {!!$about->description_english ?? "Belum Ada Data Dimasukkan"!!}
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{route('pasar_virtual')}}" class="btn btn-outline-default">Pasar Virtual</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="visi-misi mt-5">
    <img class="w-100" src="{{asset('asset/vector-atas1.png')}}" />
    <div class="bg-blue">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-2 order-md-1 my-auto">
                    <div class="py-2">
                        <div class="visi">
                            <h2 class="font-weight-bold">Visi</h2>
                            <p>
                                {!!$about->vision ?? "Belum Ada Data Dimasukkan"!!}
                            </p>
                        </div>
                        <div class="visi">
                            <h2 class="font-weight-bold">Misi</h2>
                            <p>
                                {!!$about->mission ?? "Belum Ada Data Dimasukkan"!!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 order-1 order-md-2 my-auto">
                    <img src="{{$about->image_url ?? ""}}" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
    <img class="w-100" src="{{asset('asset/vector-bawah1.png')}}" />
    <div></div>
</section>
<section class="kenapa-avesma mt-5">
    <div class="container">
        <div class="text-center">
            <h2 class="font-weight-bold">Kenapa Harus AVESMA ?</h2>
        </div>
        <div class="row text-center mt-3 h-100">
            <div class="col-md-4 order-2 order-md-1 m-auto">
                <div class="row img-kenapa">
                    <div class="col-md-12">
                        <img src="{{$benefits[0]->image_url}}" />
                        <h5 class="font-weight-bold">{{$benefits[0]->title}}</h5>
                        <p>{{$benefits[0]->description}}</p>
                    </div>
                    <div class="col-md-12">
                        <img src="{{$benefits[1]->image_url}}" />
                        <h5 class="font-weight-bold">{{$benefits[1]->title}}</h5>
                        <p>{{$benefits[1]->description}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 order-1 order-md-2">
                <img src="{{asset('asset/mockup-avesma-new.png')}}" class="img-fluid" />
                <img src="asset/playstore.png" class="img-fluid" />
            </div>
            <div class="col-md-4 order-3 order-md-3 m-auto">
                <div class="row img-kenapa">
                    <div class="col-md-12">
                        <img src="{{$benefits[2]->image_url}}" />
                        <h5 class="font-weight-bold">{{$benefits[2]->title}}</h5>
                        <p>{{$benefits[2]->description}}</p>
                    </div>
                    <div class="col-md-12">
                        <img src="{{$benefits[3]->image_url ?? ''}}" />
                        <h5 class="font-weight-bold">{{$benefits[3]->title ?? ''}}</h5>
                        <p>{{$benefits[3]->description ?? ''}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="testimoni mt-5 bg-blue-gradient pt-5">
    <div class="container-fluid">
        <div class="text-center">
            <h2 class="font-weight-bold">Testimoni</h2>
        </div>
        <div class="container">
            <div class="row h-100">
                <div class="col-md-5 my-2 my-auto">
                    <div class="container bg-white rounded-custom py-4 my-auto">
                        <div class="row text-center">
                            <div class="col-md-6 col-6">
                                <h3 class="font-weight-bold m-0">1.2M</h3>
                                <p>Aplikasi Terunduh</p>
                            </div>
                            <div class="col-md-6 col-6">
                                <h3 class="font-weight-bold m-0">999</h3>
                                <p>Jumlah Pembudidaya</p>
                            </div>
                            <div class="col-md-6 col-6">
                                <h3 class="font-weight-bold m-0">312</h3>
                                <p>Jumlah Panen / Kg</p>
                            </div>
                            <div class="col-md-6 col-6">
                                <h3 class="font-weight-bold m-0">4,5</h3>
                                <p>Penilaian Aplikasi</p>
                            </div>
                        </div>
                    </div>
                </div>
                @isset($testimonials)
                <div class="col-md-7 my-2">
                    <div class="main-carousel" data-flickity='{"prevNextButtons" : false, "wrapAround": true}'>
                        @foreach ($testimonials as $testimonial)
                        <div class="carousel-cell">
                            <div class="container bg-white rounded-custom py-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <img src="{{$testimonial->image_url}}"
                                                class="testimonial img-fluid rounded-circle"
                                                style="height: 100px; width:100px" />
                                        </div>
                                    </div>
                                    <div class="col-md-9 my-auto">
                                        <h4 class="font-weight-bold mb-0">{{$testimonial->name}}</h4>
                                        <h5>{{$testimonial->position}}</h5>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <p class="text-center" style="color: black">
                                            "{{$testimonial->message}}"
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endisset
            </div>
        </div>
    </div>
</section>
@endsection