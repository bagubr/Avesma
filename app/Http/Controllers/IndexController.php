<?php

namespace App\Http\Controllers;

use App\Http\Resources\PondResource;
use App\Models\About;
use App\Models\Benefit;
use App\Models\FishCategory;
use App\Models\IncomeDetail;
use App\Models\Pond;
use App\Models\Region;
use App\Models\Slider;
use App\Models\SliderMarket;
use App\Models\SocialMedia;
use App\Models\Testimonial;
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
        $about = About::first();
        $sliders = Slider::all();
        $testimonials = Testimonial::all();
        $benefits = Benefit::orderBy('id', 'asc')->get();
        return view('index', compact('sliders', 'testimonials', 'about', 'benefits'));
    }
    public function pasar_virtual()
    {
        $sliders = SliderMarket::all();
        $fish_categories = FishCategory::all();
        $regions = Region::all();
        $ponds = Pond::where('status', Pond::STATUS2)->get();
        return view('pasar_virtual', compact('fish_categories', 'regions', 'ponds', 'sliders'));
    }
    public function detail_pasar_virtual(Pond $pond)
    {
        return view('detail_pasar_virtual', compact('pond'));
    }
    public function kontak()
    {
        return view('contact');
    }
}
