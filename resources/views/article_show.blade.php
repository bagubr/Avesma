@extends('layouts.app')
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