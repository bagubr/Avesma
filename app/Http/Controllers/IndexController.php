<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPengajuanRequest;
use App\Http\Resources\PondResource;
use App\Models\About;
use App\Models\Benefit;
use App\Models\Buyer;
use App\Models\FishCategory;
use App\Models\IncomeDetail;
use App\Models\Pond;
use App\Models\PondHarvest;
use App\Models\Region;
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
}
