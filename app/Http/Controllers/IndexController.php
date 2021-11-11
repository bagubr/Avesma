<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        $sliders = Slider::all();
        return view('index', compact('sliders'));
    }
    public function pasar_virtual()
    {
        return view('pasar_virtual');
    }
    public function detail_pasar_virtual()
    {
        return view('detail_pasar_virtual');
    }
}
