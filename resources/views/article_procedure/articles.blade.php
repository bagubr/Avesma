@extends('layouts.app')

@section('content')
<section class="detail_pasar_virtual my-5">
    <div class="container">
        <section class="article-search">
            <h2 class="font-weight-bold text-center">Prosedur SOP</h2>
            <form action="">
                <div class="form-row mt-5">
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control font-weight-bold" name="title" value="{{old('title')}}"
                            placeholder="Cari Artikel">
                    </div>
                    <div class="col-md-4 form-group">
                        <select class="form-control font-weight-bold" name="procedure_id">
                            <option value="">Pilih Prosedur</option>
                            @foreach ($procedures as $procedure)
                            @if (old('procedure_id') == $procedure->id)
                            <option value="{{$procedure->id}}" selected>{{$procedure->title}}</option>
                            @else
                            <option value="{{$procedure->id}}">{{$procedure->title}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <select class="form-control font-weight-bold" name="fish_species_id">
                            <option value="">Pilih Spesies Ikan</option>
                            @foreach ($fish_specieses as $fish_species)
                            @if (old('fish_species_id') == $fish_species->id)
                            <option value="{{$fish_species->id}}" selected>{{$fish_species->name}}</option>
                            @else
                            <option value="{{$fish_species->id}}">{{$fish_species->name}}</option>
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
                    <p class="font-weight-bold bg-text-blue">{{$article->procedure->title}} -
                        {{$article->fish_species->name ?? ""}}</p>
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
            @endif
        </section>
    </div>
</section>
@endsection