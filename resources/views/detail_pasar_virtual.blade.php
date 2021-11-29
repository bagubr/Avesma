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
        <h1 class="font-weight-bold text-center">{{$pond->pond_detail?->fish_species?->name}}</h1>
        <div class="row mt-5">
            <div class="col-md-4 mb-3">
                <div class="text-center">
                    <img class="rounded-circle fish-detail" src="{{$pond->pond_detail->fish_species->image_url}}">
                </div>
            </div>
            <div class="col-md-8 my-auto">
                <h5 class="font-weight-bold">{{$pond->user->name}} / {{$pond->region_name}}</h5>
                <p>{{$pond->description}}</p>
                <div class="text-right">
                    <a href="https://google.com/maps/?q={{$pond->latitude}},{{$pond->longitude}}" target="_blank"
                        class="btn btn-primary">
                        <i class="fas fa-map-marker-alt"></i>
                        Cari Lokasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="form-pengajuan mt-5">
    <div class="container">
        <h2 class="text-center font-weight-bold">Form Pengajuan</h2>
        <form action="{{route('form_pengajuan', $pond->id)}}" method="POST">
            @csrf
            <div class="form-group">
                <label class="font-weight-bold">Nama <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Anda" required>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Masukkan Email Anda">
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Nomor Handphone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone" placeholder="Masukkan Nomor Handphone Anda"
                    required>
                <small class="form-text text-muted">Contoh +62812345678</small>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Pertanyaan <span class="text-danger">*</span></label>
                <textarea name="question" class="form-control" id="" cols="30" rows="10"
                    placeholder="Masukkan Petanyaan Anda" required></textarea>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="Whatsapp">
                <label class="form-check-label" for="Whatsapp">Nomor Whatsapp ?</label>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Kirim
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
@section('imagefooter')
<img class="w-100" src="{{asset('asset/footer-image.png')}}" />
@endsection