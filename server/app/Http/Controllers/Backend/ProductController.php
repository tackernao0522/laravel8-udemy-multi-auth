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
use App\Models\MultiImg;

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
        $validatedData = $request->validate([
            // 'brand_name_ja' => 'required|unique:brands',
            // 'brand_name_en' => 'required|unique:brands',
            'product_thambnail' => 'required|mimes:jpg,jpeg,png',
        ], [
            // 'brand_name_en.required' => 'Input Brand English Name',
            // 'brand_name_en.unique' => 'The brand name ja has already been taken.',
            'product_thambnail.required' => 'メインサムネイルは必須です。(Input Brand Image.)',
            'product_thambnail.mimes' => 'メインサムネイルにはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。(The Product thambnail must be a file of type: jpg, jpeg, png.)',
        ]);

        $fileName = $this->saveImage($request->file('product_thambnail'));

        $product_id = Product::insertGetId([
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

        $images = $request->file('multi_img');

        foreach ($images as $img) {
            $tempPath2 = $this->makeTempPath();
            Image::make($img)->resize(917, 1000)->save($tempPath2);

            $filePath2 = Storage::disk('s3')
                ->putFile('products/multi-image', new File($tempPath2));

            $multiImageName = basename($filePath2);

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $multiImageName,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => '商品を登録しました。(Product Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->route('manage-product')
            ->with($notification);
    }

    public function manageProduct()
    {
        $products = Product::latest()->get();

        return view('backend.product.product_view', compact('products'));
    }

    public function productEdit($id)
    {
        $multiImgs = MultiImg::where('product_id', $id)->get();
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subCategories = SubCategory::latest()->get();
        $subSubCategories = SubSubCategory::latest()->get();
        $product = Product::findOrFail($id);

        return view('backend.product.product_edit', compact(
            'categories',
            'brands',
            'subCategories',
            'subSubCategories',
            'product',
            'multiImgs',
        ));
    }

    public function productDataUpdate(Request $request)
    {
        $product_id = $request->id;

        Product::findOrFail($product_id)->update([
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
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'spacial_offer' => $request->spacial_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '商品ID：' . $product_id . 'を更新しました。(Product Updated Without Image Successfully)',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);
    }

    public function multiImageUpdate(Request $request)
    {
        $imgs = $request->multi_img;

        if ($imgs) {
            foreach ($imgs as $id => $img) {
                $imgDel = MultiImg::findOrFail($id);
                Storage::disk('s3')->delete('products/multi-image/' . $imgDel->photo_name);
                $imgDel->delete();

                $tempPath2 = $this->makeTempPath();
                Image::make($img)->resize(917, 1000)->save($tempPath2);

                $filePath2 = Storage::disk('s3')
                    ->putFile('products/multi-image', new File($tempPath2));

                $multiImageName = basename($filePath2);

                $imgDel->photo_name = $multiImageName;
                $imgDel->updated_at = Carbon::now();
                $imgDel->save();
            }
        }

        $notification = array(
            'message' => '画像を更新しました。(Product Image Updated Successfully)',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function thambnailImageUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validatedData = $request->validate([
            // 'brand_name_ja' => 'required|unique:brands',
            // 'brand_name_en' => 'required|unique:brands',
            'product_thambnail' => 'mimes:jpg,jpeg,png',
        ], [
            // 'brand_name_en.required' => 'Input Brand English Name',
            // 'brand_name_en.unique' => 'The brand name ja has already been taken.',
            // 'product_thambnail.required' => 'メインサムネイルは必須です。(Input Brand Image.)',
            'product_thambnail.mimes' => 'メインサムネイルにはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。(The Product thambnail must be a file of type: jpg, jpeg, png.)',
        ]);

        if ($request->has('product_thambnail')) {
            Storage::disk('s3')->delete('/products/thambnail/' . $product->product_thambnail);
            $product->delete();
            $fileName = $this->saveImage($request->file('product_thambnail'));
            $product->product_thambnail = $fileName;
            $product->updated_at = Carbon::now();
            $product->save();
        }

        $notification = array(
            'message' => 'サムネイルを更新しました。(Thambnail Image Updated Successfully)',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function multiImageDelete($id)
    {
        $multiImg = MultiImg::findOrFail($id);
        Storage::disk('s3')->delete('/products/multi-image/' . $multiImg->photo_name);
        $multiImg->delete();

        $notification = array(
            'message' => 'マルチ画像ID：' . $multiImg->id . 'を削除しました。',
            'alert-type' => 'error',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function productInactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => '販売停止しました。',
            'alert-type' => 'error',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function productActive($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => '販売開始しました。',
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
