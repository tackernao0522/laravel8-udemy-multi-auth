<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;

class ProductController extends Controller
{
    public function addProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('backend.product.product_add', compact('categories', 'brands'));
    }

    public function storeProduct(Request $request)
    {
        $fileName = $this->saveImage($request->file('product_thambnail'));

        Product::insert([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subCategory_id' => $request->subCategory_id,
            'subSubCategory_id' => $request->subSubCategory_id,
            'product_name_ja' => $request->product_name_ja,
            'product_name_en' => $request->product_name_en,
            'product_slug_ja' => str_replace(' ', '-', $request->product_name_ja),
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_ja' => $request->product_tags_ja,
            'product_tags_en' => $request->product_tags_en,
            'product_size_ja' => $request->product_size_ja,
            'product_size_en' => $request->product_size_en,
            'product_color_ja' => $request->product_color_ja,
            'product_color_en' => $request->product_color_en,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_ja' => $request->short_descp_ja,
            'short_descp_en' => $request->short_descp_en,
            'long_descp_ja' => $request->long_descp_ja,
            'long_descp_en' => $request->long_descp_en,
            'product_thambnail' => $fileName,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'spacial_offer' => $request->spacial_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '商品を登録しました。(Product Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->resize(917, 1000)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('products/thambnail', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
