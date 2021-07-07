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
            'brand_name_en.unique' => 'The brand name ja has already been taken.',
            'brand_image.required' => 'ブランドロゴは必須です。(Input Brand Image.)',
            'brand_image.mimes' => 'ブランドロゴにはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。(The brand image must be a file of type: jpg, jpeg, png.)',
        ]);

        $fileName = $this->saveImage($request->file('brand_image'));

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

    public function brandEdit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function brandUpdate(Request $request, $id)
    {
        $brand = Brand::find($id);
        $validatedData = $request->validate([
            'brand_name_ja' => 'required',
            'brand_name_en' => 'required',
            'brand_image' => 'mimes:jpg,jpeg,png',
        ], [
            'brand_name_en.required' => 'Input Brand English Name',
            'brand_image.mimes' => 'ブランドロゴにはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。(The brand image must be a file of type: jpg, jpeg, png.)',
        ]);

        if ($request->has('brand_image')) {
            Storage::disk('s3')->delete('/brands/' . $brand->brand_image);
            $brand->delete();
            $fileName = $this->saveImage($request->file('brand_image'));
            $brand->brand_image = $fileName;
        }

        $brand->brand_name_ja = $request->brand_name_ja;
        $brand->brand_name_en = $request->brand_name_en;
        $brand->brand_slug_ja = str_replace(' ', '-', $request->brand_name_ja);
        $brand->brand_slug_en = strtolower(str_replace(' ', '-', $request->brand_name_en));
        $brand->save();

        $notification = array(
            'message' => 'ブランドID：' . $brand->id . 'を更新しました(Brand Updated Successfully)。',
            'alert-type' => 'info',
        );

        return redirect()->route('all.brand')
            ->with($notification);
    }

    public function brandDelete($id)
    {
        $brand = Brand::find($id);
        Storage::disk('s3')->delete('/brands/' . $brand->brand_image);
        $brand->delete();

        $notification = array(
            'message' => 'ブランド：' . $brand->brand_name_ja . 'を削除しました。',
            'alert-type' => 'error',
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
