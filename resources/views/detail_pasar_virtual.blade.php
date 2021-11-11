@extends('layouts.app')
@push('css')
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
<section class="detail_pasar_virtual mt-5">
    <div class="container">
        <h1 class="font-weight-bold text-center">Detail Pasar Virtual</h1>
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="text-center">
                    <img class="rounded-circle fish-detail" src="{{asset('asset/fakta-ikan-nila-2_169.jpeg')}}">
                </div>
            </div>
            <div class="col-md-8 my-auto">
                <h3 class="font-weight-bold">Ikan Nila</h3>
                <h5 class="font-weight-bold">Nama Petani / Area / 10 Kg</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae alias nulla voluptatibus soluta
                    nobis, saepe impedit. Nostrum nemo enim dolores saepe sint, illum rem magnam laboriosam ab! Rem,
                    aliquam voluptatibus.</p>
                <div class="text-right">
                    <div class="btn btn-primary"><i class="fas fa-map-marker-alt"></i> Cari Lokasi</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('imagefooter')
<img class="w-100" src="{{asset('asset/footer-image.png')}}" />
@endsection