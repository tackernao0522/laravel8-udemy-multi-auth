<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Brand;

class BrandController extends Controller
{
    public function brandView()
    {
        $brands = Brand::latest()->get();

        return view('backend.brand.brand_view', compact('brands'));
    }

    public function brandStore(Request $request)
    {

        $validatedData = $request->validate([
            'brand_name_ja' => 'required|unique:brands',
            'brand_name_en' => 'required|unique:brands',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ], [
            'brand_name_en.required' => 'Input Brand English Name',
            'brand_image.required' => 'ブランドロゴは必須です。(Input Brand Image.)',
            'brand_image.mimes' => 'ブランドロゴにはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。(The brand image must be a file of type: jpg, jpeg, png.)',
        ]);

        $fileName = $this->saveImage($request->file('brand_image'));
        // $brand->brand_image = $fileName;

        // $brand = new Brand();
        // $brand->brand_name = $request->brand_name;
        // $brand->brand_image = $fileName;
        // $brand->created_at = Carbon::now();
        // $brand->save();

        Brand::insert([
            'brand_name_ja' => $request->brand_name_ja,
            'brand_name_en' => $request->brand_name_en,
            'brand_slug_ja' => str_replace(' ', '-', $request->brand_name_ja),
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_image' => $fileName,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ブランドを作成しました。(Brand Inserred Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->resize(300, 300)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('brands', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
