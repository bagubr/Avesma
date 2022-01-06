@extends('layouts.app')

@section('content')
<section class="detail_pasar_virtual my-5">
    <div class="container">
        <section class="article-search">
            <h2 class="font-weight-bold text-center">Artikel Umum</h2>
            <form action="">
                <div class="form-row mt-5">
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control font-weight-bold" name="title"
                            placeholder="Cari Artikel">
                    </div>
                    <div class="col-md-6 form-group">
                        <select class="form-control font-weight-bold" name="article_category_id">
                            <option value="">Pilih Kategori Artikel</option>
                            @foreach ($article_categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="text-right">
                    <button class="btn btn-primary font-weight-bold rounded-custom btn-cari" type="submit">
                        <i class="fas fa-search"></i>
                        Cari Artikel
                    </button>
                </div>
            </form>
        </section>
        <section class="article-search">
            @foreach ($articles as $article)
            <div class="row mt-3">
                <div class="col-md-4 ">
                    <a href="{{route('article.show', $article->id)}}">
                        <img src="{{$article->image_url}}" class="img-fluid" style="height: 250px; width: 100%" alt="">
                    </a>
                </div>
                <div class="col-md-8">
                    <a href="{{route('article.show', $article->id)}}" class="article">
                        <h5 class="font-weight-bold">{{$article->title}}</h5>
                    </a>
                    <p class="font-weight-bold bg-text-blue">{{$article->category_name}}</p>
                    <p>
                        {{strip_tags(Str::limit($article->description, 500))}}
                    </p>
                </div>
            </div>
            @endforeach

        </section>
    </div>
</section>
@endsection