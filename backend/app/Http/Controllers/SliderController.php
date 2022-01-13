<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index() {
        $slider = Slider::where('active',1)->get();
        return response($slider);
    }
}
