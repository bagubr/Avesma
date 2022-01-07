@extends('layouts.app')
@push('css')
<style>
    hr {
        border-top: 2px solid;
    }
</style>
@endpush
@section('content')
<section class="detail_pasar_virtual my-5">
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
                    <p class="font-weight-bold bg-text-blue">Umum - {{$a->category_name}} / Dipublikasikan
                        {{$a->created_at}}
                    </p>
                </div>
                @endforeach
                <div class="ml-auto">
                    <a href="{{route('article.all')}}" class="btn btn-primary">Lihat Lainnya</a>
                </div>

            </div>
        </section>
        <hr class="my-3">
        <section class="article-prosedur-resep">
            <div class="row mt-4">
                <div class="col-md-6">
                    <h2 class="font-weight-bold text-left">Prosedur SOP</h2>
                    <div class="row">
                        @foreach ($article_procedures as $article_procedure)
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <div class="col-md-5">
                                    <a href="{{route('article.procedure.show', $article_procedure->id)}}">
                                        <img src="{{$article_procedure->image_url}}" class="img-fluid w-100"
                                            style="height: 150px;">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="{{route('article.procedure.show', $article_procedure->id)}}"
                                        class="article">
                                        <p class="font-weight-bold mb-0">{{$article_procedure->title}}</p>
                                    </a>
                                    <p class="font-weight-bold bg-text-blue mb-0">
                                        {{$article_procedure->procedure->title}}</p>
                                    <p class="font-weight-bold align-bottom">Dipublikasikan Pada
                                        {{$article_procedure->created_at}}</p>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        @endforeach
                        <div class="ml-auto">
                            <a href="{{route('article.procedure.all')}}" class="btn btn-primary">Lihat Lainnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="font-weight-bold text-left">Artikel Resep</h2>
                    <div class="row">
                        @foreach ($article_recipes as $article_recipe)
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <div class="col-md-5">
                                    <a href="{{route('article.recipe.show', $article_recipe->id)}}">
                                        <img src="{{$article_recipe->image_url}}" class="img-fluid w-100"
                                            style="height: 150px;">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="{{route('article.recipe.show', $article_recipe->id)}}" class="article">
                                        <p class="font-weight-bold mb-0">{{$article_recipe->title}}</p>
                                    </a>
                                    <p class="font-weight-bold align-bottom">Dipublikasikan Pada
                                        {{$article_recipe->created_at}}</p>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        @endforeach
                        <div class="ml-auto">
                            <a href="" class="btn btn-primary">Lihat Lainnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection