@extends('layouts.app')
@section('content')
<section class="detail_pasar_virtual mt-5">
    <div class="container">
        <div class="text-center">
            <h4 class="font-weight-bold">{{$article->title}}</h4>
            <img src="{{$article->image_url}}" alt="" class="img-fluid mt-3">
        </div>
        <div class="mt-2">
            <p class="font-weight-bold bg-text-blue">{{$article->category_name}} / Dipublikasikan Pada
                {{$article->created_at}}</p>
            {!!$article->description!!}
            <div class="embed-responsive embed-responsive-16by9 mx-auto">
                <iframe class="embed-responsive-item" src="{{$article->embed_link}}"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
@endsection