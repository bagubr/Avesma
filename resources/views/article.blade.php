@extends('layouts.app')
@push('css')
<style>
    hr {
        border: 2px solid;
    }
</style>
@endpush
@section('content')
<section class="detail_pasar_virtual mt-5">
    <div class="container">
        <section class="article">
            <h2 class="font-weight-bold text-center">Artikel Umum Terbaru</h2>
            <div class="row mt-5 mx-auto">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{route('article.show', $article->id)}}">
                            <img src="{{$article->image_url}}" class="img-fluid h-100" alt="">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <a href="{{route('article.show', $article->id)}}" class="article">
                            <h5 class="font-weight-bold">{{$article->title}}</h5>
                        </a>
                        <p class="font-weight-bold bg-text-blue">Umum - {{$article->category_name}} / Dipublikasikan
                            {{$article->created_at}}</p>
                        <p>
                            {{strip_tags(Str::limit($article->description, 500))}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                @foreach ($article_all as $a)
                @if ($loop->first) @continue @endif
                <div class="col-md-2 mt-1">
                    <a href="{{route('article.show', $a->id)}}">
                        <img src="{{$a->image_url}}" style="height: 150px;" class="img-fluid w-100" alt="">
                    </a>
                </div>
                <div class="col-md-4 mt-1">
                    <a href="{{route('article.show', $a->id)}}" class="article">
                        <h5 class="font-weight-bold">{{$a->title}}</h5>
                    </a>
                    <p class="font-weight-bold bg-text-blue">Umum - {{$a->category_name}} / Dipublikasikan {{$a->created_at}}
                    </p>
                </div>
                @endforeach
                <div class="ml-auto">
                    <a href="" class="btn btn-primary">Lihat Lainnya</a>
                </div>

            </div>
        </section>
        <hr class="my-3">
        <section class="article-prosedur-resep">
            <h2 class="font-weight-bold text-left">Prosedur SOP</h2>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{asset('asset/screenshot_5.png')}}" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-7">
                            <a href="" class="article">
                                <h4 class="font-weight-bold">Pembesaran Ikan Lele 2022</h4>
                            </a>
                            <p class="font-weight-bold bg-text-blue mb-0">SOP Pembesaran / Ikan Lele</p>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi dicta recusandae illo
                                nulla
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum consequatur doloribus possimus quo
                    ullam. Exercitationem, porro minus ratione officia itaque corrupti debitis nostrum placeat ex
                    architecto perspiciatis dolores sapiente ducimus.
                </div>
            </div>
        </section>
    </div>
</section>
@endsection