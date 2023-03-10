@extends('layouts.app')

@section('content')
<section class="detail_pasar_virtual my-5">
    <div class="container">
        <section class="article-search">
            <h2 class="font-weight-bold text-center">Artikel Umum</h2>
            <form action="">
                <div class="form-row mt-5">
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control font-weight-bold" name="title" value="{{old('title')}}"
                            placeholder="Cari Artikel">
                    </div>
                    <div class="col-md-6 form-group">
                        <select class="form-control font-weight-bold" name="article_category_id">
                            <option value="">Pilih Kategori</option>
                            @foreach ($article_categories as $category)
                            @if (old('article_category_id') == $category->id)
                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
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
            @if (empty($article))
            <div class="text-center mx-auto">
                <img src="{{asset('asset/icon-kosong-avesma-tidak-ada-data-12.png')}}" style="height: 200px"
                    class="img-fluid" alt="">
                <h5 class="mt-3">Artikel Yang Anda Cari Tidak Ada</h5>
            </div>
            @else
            <div class="d-flex justify-content-center">
                {!! $articles->links() !!}
            </div>
            @endif
        </section>
    </div>
</section>
@endsection