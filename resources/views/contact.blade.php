@extends('layouts.app')
@section('content')
<section class="contact mt-5">
    <div class="container">
        <h1 class="font-weight-bold text-center">Kontak Bantuan</h1>
        <form action="{{route('contact.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label class="font-weight-bold">Nama <span class="text-danger">*</span></label>
                <input name="name" type="text" class="form-control" placeholder="Masukkan Nama Anda" required>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Masukkan Email Anda" >
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Nomor Handphone <span class="text-danger">*</span></label>
                <input name="phone" type="text" class="form-control" placeholder="Masukkan Nomor Handphone Anda" required>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Pesan <span class="text-danger">*</span></label>
                <textarea name="message" class="form-control" required placeholder="Masukkan Pesan"></textarea>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim</button>
            </div>
        </form>
    </div>
</section>
@endsection
@section('imagefooter')
<img class="w-100" src="{{asset('asset/footer-image.png')}}" />
@endsection