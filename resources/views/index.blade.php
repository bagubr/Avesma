@extends('layouts.app')
@section('content')
<section class="hero">
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-md-1"></div>
            <div class="col-md-5 order-2 order-md-1 my-auto">
                <h1 class="font-weight-bold">Avesma</h1>
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
                <div class="main-carousel">
                    <div class="carousel-cell">
                        <img src="{{asset('asset/image-2.jpg')}}" class="img-fluid" />
                    </div>
                    <div class="carousel-cell">
                        <img src="{{asset('asset/image-2.jpg')}}" class="img-fluid" />
                    </div>
                    <div class="carousel-cell">
                        <img src="{{asset('asset/image-2.jpg')}}" class="img-fluid" />
                    </div>
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
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/dEnplvG7jEE"
                        allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="font-weight-bold">Tentang Kita</h2>
                <p class="text-justify">
                    AVESMA merupakan aplikasi handphone yang dibuat bagi pembudidaya
                    ikan untuk memberikan informasi cara budidaya ikan yang baik
                    berdasarkan aturan SNI. Aplikasi ini diwujudkan untuk membantu
                    pernyuluh yang jumlahnya masih sangat kurang di Indonesia sehingga
                    tidak dapat secara maksimal membantu pembudidaya di lapangan. Kami
                    ucapkan terima kasih kepada NWO-WOTRO, Belanda yang sudah
                    memberikan dana project ini sehingga project ini dapat terlaksana
                    dengan baik. Semoga dengan aplikasi ini, pembudidaya Indonesia
                    menjadi semakin berkembang pengetahuan dan kesejahteraannya. Jaya
                    Pembudidaya Kita…Jaya Akuakultur Indonesia!
                </p>
                <div class="text-right">
                    <button class="btn btn-outline-default">Pasar Virtual</button>
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
                <div class="col-md-6 my-auto">
                    <div class="py-2">
                        <div class="visi">
                            <h2 class="font-weight-bold">Visi</h2>
                            <p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                Deleniti odit omnis animi consequuntur mod
                            </p>
                        </div>
                        <div class="visi">
                            <h2 class="font-weight-bold">Misi</h2>
                            <p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                Deleniti odit omnis animi consequuntur modi nesciunt
                                explicabo rerum earum reiciendis voluptatum in dolorem optio
                                aliquid dolor, quibusdam esse sequi saepe fugit!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-auto">
                    <img src="{{asset('asset/visi-misi.png')}}" class="img-fluid" />
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
            <h2 class="font-weight-bold">Kenapa Harus Avesma ?</h2>
        </div>
        <div class="row text-center mt-3 h-100">
            <div class="col-md-4 order-2 order-md-1 m-auto">
                <div class="row">
                    <div class="col col-md-12">
                        <img src="{{asset('asset/asset-kenapa.png')}}" />
                        <h4 class="font-weight-bold">Judul</h4>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="col col-md-12">
                        <img src="{{asset('asset/asset-kenapa.png')}}" />
                        <h4 class="font-weight-bold">Judul</h4>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 order-1 order-md-2">
                <img src="asset/android-phone.png" class="img-fluid" />
                <img src="asset/playstore.png" class="img-fluid" />
            </div>
            <div class="col-md-4 order-3 order-md-3 m-auto">
                <div class="row">
                    <div class="col col-md-12">
                        <img src="{{asset('asset/asset-kenapa.png')}}" />
                        <h4 class="font-weight-bold">Judul</h4>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="col col-md-12">
                        <img src="{{asset('asset/asset-kenapa.png')}}" />
                        <h4 class="font-weight-bold">Judul</h4>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
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
                                <p>Jumlah Petani</p>
                            </div>
                            <div class="col-md-6 col-6">
                                <h3 class="font-weight-bold m-0">312</h3>
                                <p>Transaksi Berhasil</p>
                            </div>
                            <div class="col-md-6 col-6">
                                <h3 class="font-weight-bold m-0">4,5</h3>
                                <p>Penilaian Aplikasi</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 my-2">
                    <div class="container bg-white rounded-custom py-4">
                        <div class="row h-100">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <img src="asset/screenshot_5.png" class="img-fluid rounded-circle"
                                        style="height: 100px" />
                                </div>
                            </div>
                            <div class="col-md-9 my-auto">
                                <h4 class="font-weight-bold mb-0">Satrio Jati Wicaksono</h4>
                                <h5>Can Creative</h5>
                            </div>
                            <div class="col-md-12 mt-4">
                                <p class="text-center" style="color: black">
                                    "Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Repudiandae, fuga!"
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection