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
}
