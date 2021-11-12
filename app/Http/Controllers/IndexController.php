<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\FishCategory;
use App\Models\Region;
use App\Models\Slider;
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
        return view('index', compact('sliders', 'testimonials', 'about'));
    }
    public function pasar_virtual()
    {
        $fish_categories = FishCategory::all();
        $regions = Region::all();
        return view('pasar_virtual', compact('fish_categories', 'regions'));
    }
    public function detail_pasar_virtual()
    {
        return view('detail_pasar_virtual');
    }
    public function kontak()
    {
        return view('contact');
    }
}
