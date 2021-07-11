<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Slider;

class SliderController extends Controller
{
    public function sliderView()
    {
        $sliders = Slider::latest()->get();

        return view('backend.slider.slider_view', compact('sliders'));
    }
}
