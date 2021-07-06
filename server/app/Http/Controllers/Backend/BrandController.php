<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ]);

        $fileName = $this->saveImage($request->file('brand_image'));
        // $brand->brand_image = $fileName;

        // $brand = new Brand();
        // $brand->brand_name = $request->brand_name;
        // $brand->brand_image = $fileName;
        // $brand->created_at = Carbon::now();
        // $brand->save();

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $fileName,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ブランドを作成しました。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->resize(300, 200)->save($tempPath);

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
