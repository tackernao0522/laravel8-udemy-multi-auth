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

    public function sliderStore(Request $request)
    {
        $validatedData = $request->validate([
        //     'brand_name_ja' => 'required|unique:brands',
        //     'brand_name_en' => 'required|unique:brands',
            'slider_img' => 'required|mimes:jpg,jpeg,png',
        ], [
            // 'brand_name_en.required' => 'Input Brand English Name',
            // 'brand_name_en.unique' => 'The brand name ja has already been taken.',
            'slider_img.required' => 'スライダー画像は必須です。(Input Slider Image.)',
            'slider_img.mimes' => 'スライダー画像にはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。(The slider image must be a file of type: jpg, jpeg, png.)',
        ]);

        $fileName = $this->saveImage($request->file('slider_img'));

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'slider_img' => $fileName,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'スライダーを作成しました。(Slider Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->resize(870, 370)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('sliders', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
