@extends('layouts.app')
@push('css')
<style>
/* Nek Meh nganggo btn-bg biasa rak po sih sing koyo btn-primary/info/dangerdll */
.btn-whatsapp {
    color: #fff;
    background-color: #25D366;
    border-color: #25D366;
}
.btn-whatsapp:hover {
    color: #fff;
    background-color: #1b9e4b;
    border-color: #25D366;
}

.btn-facebook {
    color: #fff;
    background-color: #4267B2;
    border-color: #4267B2;
}
.btn-facebook:hover{
    color: #fff;
    background-color: #344f87;
    border-color: #4267B2;
}
.btn-twitter{
    color: #fff;
    background-color: #1DA1F2;
    border-color: #1DA1F2;
}
.btn-twitter:hover{
    color: #fff;
    background-color: #1577b5;
    border-color: #1DA1F2;
}
.btn-email{
    color: #fff;
    background-color: #000000;
    border-color: #000000;
}
.btn-email:hover{
    color: #fff;
    background-color: #000000;
    border-color: #000000;
}
</style>
@endpush

@section('content')
<section class="detail_pasar_virtual my-5">
    <div class="container">
        <section class="article">
            <div class="text-center">
                <h4 class="font-weight-bold">{{$article->title}}</h4>
                <img src="{{$article->image_url}}" alt="" class="img-fluid mt-3">
            </div>
            <div class="mt-2">
                <p class="font-weight-bold bg-text-blue">{{$article->category_name}} / Dipublikasikan Pada
                    {{$article->created_at}}</p>
                    <div class="container"></div>
                    <div class="mb-2 row justify-content-md-left">
                        <span class="font-weight-bold col-1 mt-2">Share : </span>
                        <div class="btn-toolbar col" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-auto" role="group" aria-label="First group">
                              <a data-toggle="tooltip" target="_blank" href="https://twitter.com/share?url={{urlencode(Request::url())}}" data-placement="top" title="Bagikan via Twitter" type="button" class="btn mx-2 btn-twitter rounded"><span class="fab fa-twitter fa-lg" aria-hidden="true"></span></a>
                              <a data-toggle="tooltip" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(Request::url())}}" data-placement="top" title="Bagikan via Facebook" type="button" class="btn mx-2 btn-facebook rounded"><span class="fab fa-facebook fa-lg" aria-hidden="true"></span></a>
                              <a data-toggle="tooltip" target="_blank" href="mailto:?subject={{urlencode($article->title)}}&body={{ urlencode(substr($article->description, 0, 50) . " - " . Request::url())}}" data-placement="top" title="Bagikan via Email" type="button" class="btn rounded mx-2 btn-email"><span class="fas fa-envelope-open-text fa-lg" aria-hidden="true"></span></a>
                              <a data-toggle="tooltip" target="_blank" href="https://web.whatsapp.com/send?text={{urlencode(Request::url())}}" data-placement="top" title="Bagikan via Whatsapp" type="button" class="btn mx-2 btn-whatsapp rounded"><span class="fab fa-whatsapp fa-lg" aria-hidden="true"></span></a>
                            </div>
                        </div>
                    </div>
                    </div>
                {!!$article->description!!}
                @if ($article->type == 'VIDEO_EMBED')
                <div class="embed-responsive embed-responsive-16by9 mx-auto mt-3">
                    <iframe class="embed-responsive-item"
                        src="{{str_replace('youtu.be/','youtube.com/embed/', $article->embed_link_website)}}"
                        allowfullscreen></iframe>
                </div>
                @elseif ($article->type == 'FILE')
                <div class="text-center">
                    <a href="{{$article->file}}" download>
                        <img src="{{asset('asset/logo-donwload avesma-16.png')}}" class="img-fluid" style="height: 150px">
                    </a>
                </div>
                @endif
            </div>
        </section>
        <section class="other-article mt-5">
            <h4 class="font-weight-bold">Artikel Lainnya</h4>
            <div class="row">
                @foreach ($other_articles as $other_article)
                <div class="col-md-6 mt-3">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="{{route('article.show', $other_article->id)}}">
                                <img src="{{$other_article->image_url}}" class="img-fluid w-100" style="height: 150px;">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="{{route('article.show', $other_article->id)}}" class="article">
                                <p class="font-weight-bold mb-0">{{$other_article->title}}</p>
                            </a>
                            <p class="font-weight-bold bg-text-blue">{{$other_article->category_name}} / Dipublikasikan
                                Pada
                                {{$other_article->created_at}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</section>
@endsection
