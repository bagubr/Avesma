<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPengajuanRequest;
use App\Http\Resources\PondResource;
use App\Models\About;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleProcedure;
use App\Models\ArticleRecipe;
use App\Models\Benefit;
use App\Models\Buyer;
use App\Models\CustomerService;
use App\Models\FishCategory;
use App\Models\FishSpecies;
use App\Models\HomeSlider;
use App\Models\IncomeDetail;
use App\Models\Pond;
use App\Models\PondHarvest;
use App\Models\Procedure;
use App\Models\Region;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\SliderMarket;
use App\Models\SocialMedia;
use App\Models\Testimonial;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct()
    {
        $social_medias = SocialMedia::all();
        view()->share('social_medias', $social_medias);
    }
    public function home()
    {
        $setting = Setting::first();
        $about = About::first();
        $sliders = HomeSlider::all();
        $testimonials = Testimonial::all();
        $benefits = Benefit::orderBy('id', 'asc')->get();
        return view('index', compact('sliders', 'testimonials', 'about', 'benefits', 'setting'));
    }
    public function pasar_virtual()
    {
        $sliders = SliderMarket::all();
        $fish_categories = FishCategory::all();
        $regions = Region::all();
        $ponds = Pond::where('status', Pond::STATUS2)->get();
        return view('pasar_virtual', compact('fish_categories', 'regions', 'ponds', 'sliders'));
    }
    public function detail_pasar_virtual(PondHarvest $pond_harvest)
    {
        return view('detail_pasar_virtual', compact('pond_harvest'));
    }
    public function form_pengajuan(FormPengajuanRequest $request, PondHarvest $pond_harvest)
    {
        $number = $request->phone;
        $country_code = '62';
        $isZero = substr($number, 0, 1);
        if ($isZero == '0') {
            $number = substr_replace($number, '+' . $country_code, 0, ($number[0] == '0'));
        } else {
            $data['phone'] = $number;
        }

        Buyer::create([
            'pond_harvest_id' => $pond_harvest->id,
            'name' => $request->name,
            'phone' => $number,
            'status' => Buyer::STATUS1,
            'question' => $request->question
        ]);
        NotificationService::sendTo($pond_harvest->pond_detail->pond_spesies . ' Ada Peminat Baru', $request->question, $pond_harvest->pond_detail->pond->user, $pond_harvest);
        session()->flash('success', 'Terimakasih, Pengajuan Anda Sedang Diproses Oleh Pembudidaya');
        return back();
    }
    public function kontak()
    {
        return view('contact');
    }
    public function article()
    {
        $articles = Article::orderBy('id', 'desc');
        $article_all = $articles->get()->take(5);
        $article = $articles->first();
        $article_procedures = ArticleProcedure::orderBy('id', 'desc')->get()->take(4);
        $article_recipes = ArticleRecipe::orderBy('id', 'desc')->get()->take(4);
        return view('article', compact('article', 'article_all', 'article_procedures', 'article_recipes'));
    }
    public function article_show(Article $article)
    {
        $other_articles = Article::inRandomOrder()->get()->take(4);
        return view('article.article_show', compact('article', 'other_articles'));
    }

    public function article_procedure_show(ArticleProcedure $article_procedure)
    {
        $other_articles = ArticleProcedure::inRandomOrder()->get()->take(4);
        return view('article_procedure.article_show', compact('article_procedure', 'other_articles'));
    }

    public function article_recipe_show(ArticleRecipe $article_recipe)
    {
        $other_articles = ArticleRecipe::inRandomOrder()->get()->take(4);
        return view('article_recipe.article_show', compact('article_recipe', 'other_articles'));
    }

    public function article_all(Request $request)
    {
        $title = $request->title;
        $article_category_id = $request->article_category_id;
        $articles = Article::when($title, function ($q) use ($title) {
            $q->where('title', 'ilike', '%' . $title . '%');
        })->when($article_category_id, function ($q) use ($article_category_id) {
            $q->where('article_category_id', $article_category_id);
        })->orderBy('id', 'desc')->paginate(5);
        $article_categories = ArticleCategory::all();
        $flash = $request->flash();
        return view('article.articles', compact('articles', 'article_categories', 'flash'));
    }

    public function article_procedure_all(Request $request)
    {
        $title = $request->title;
        $procedure_id = $request->procedure_id;
        $fish_species_id = $request->fish_species_id;
        $articles = ArticleProcedure::when($title, function ($q) use ($title) {
            $q->where('title', 'ilike', '%' . $title . '%');
        })->when($procedure_id, function ($q) use ($procedure_id) {
            $q->where('procedure_id', $procedure_id);
        })->when($fish_species_id, function ($q) use ($fish_species_id) {
            $q->where('fish_species_id', $fish_species_id);
        })->orderBy('id', 'desc')->paginate(5);
        $procedures = Procedure::all();
        $fish_specieses = FishSpecies::all();
        $flash = $request->flash();
        return view('article_procedure.articles', compact('articles', 'procedures', 'fish_specieses', 'flash'));
    }

    public function article_recipe_all(Request $request)
    {
        $title = $request->title;
        $articles = ArticleRecipe::when($title, function ($q) use ($title) {
            $q->where('title', 'ilike', '%' . $title . '%');
        })->orderBy('id', 'desc')->paginate(5);
        $flash = $request->flash();
        return view('article_recipe.articles', compact('articles', 'flash'));
    }

    public function contact_store(Request $request)
    {
        CustomerService::create($request->all());
        session()->flash('success', 'Terimakasih, Pesan anda sudah disimpan');
        return back();
    }
}
