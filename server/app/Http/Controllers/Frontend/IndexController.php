<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Brand;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit(6)->get();
        $categories = Category::orderBy('category_name_ja', 'ASC')->get();
        $sliders = Slider::where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit(3)->get();
        $featured = Product::where('featured', 1)
            ->orderBy('id', 'DESC')
            ->limit(6)->get();
        $hot_deals = Product::where('hot_deals', 1)
            ->where('discount_price', '!=', NULL)
            ->orderBy('id', 'DESC')->limit(3)->get();
        $spacial_offer = Product::where('spacial_offer', 1)
            ->orderBy('id', 'DESC')->limit(6)->get();
        $special_deals = Product::where('special_deals', 1)
            ->orderBy('id', 'DESC')->limit(3)->get();
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status', 1)
            ->where('category_id', $skip_category_0->id)
            ->orderBy('id', 'DESC')->get();
        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', 1)
            ->where('category_id', $skip_category_1->id)
            ->orderBy('id', 'DESC')->get();
        $skip_brand_9 = Brand::skip(9)->first();
        $skip_brand_product_9 = Product::where('status', 1)
            ->where('brand_id', $skip_brand_9->id)
            ->orderBy('id', 'DESC')->get();

        // return $skip_category->id;
        // die();

        return view('frontend.index', compact(
            'categories',
            'sliders',
            'products',
            'featured',
            'hot_deals',
            'spacial_offer',
            'special_deals',
            'skip_category_0',
            'skip_product_0',
            'skip_category_1',
            'skip_product_1',
            'skip_brand_9',
            'skip_brand_product_9',
        ));
    }

    public function userLogout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function userProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.user_profile', compact('user'));
    }

    public function userProfileStore(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->has('profile_photo_path')) {
            Storage::disk('s3')->delete('/user-profile/' . $data->profile_photo_path);
            $data->delete();
            $fileName = $this->saveImage($request->file('profile_photo_path'));
            $data['profile_photo_path'] = $fileName;
        }

        $data->save();

        $nofification = array(
            'message' => 'ユーザープロフィールを更新しました。',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($nofification);
    }

    public function userChangePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.change_password', compact('user'));
    }

    public function userPasswordUpdate(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('user.logout');
        } else {
            $nofification = array(
                'message' => '現在のパスワードが一致しません。',
                'alert-type' => 'error'
            );
            return redirect()->back()
                ->with($nofification);
        }
    }

    public function productDetails($id, $slug)
    {
        $product = Product::findOrFail($id);
        $color_ja = $product->product_color_ja;
        $product_color_ja = explode(',', $color_ja);
        $color_en = $product->product_color_en;
        $product_color_en = explode(',', $color_en);
        $size_ja = $product->product_size_ja;
        $product_size_ja = explode(',', $size_ja);
        $size_en = $product->product_size_en;
        $product_size_en = explode(',', $size_en);
        $multiImage = MultiImg::where('product_id', $id)->get();

        return view('frontend.product.product_details', compact(
            'product',
            'multiImage',
            'product_color_ja',
            'product_color_en',
            'product_size_ja',
            'product_size_en'
        ));
    }

    public function tagWiseProduct($tag)
    {
        if (session()->get('language') == 'english') {
            $products = Product::where('status', 1)->where('product_tags_en', $tag)->orderBy('id', 'DESC')->paginate(3);
        } else {
            $products = Product::where('status', 1)->where('product_tags_ja', $tag)->orderBy('id', 'DESC')->paginate(3);
        }

        $categories = Category::orderBy('category_name_ja', 'ASC')->get();

        return view('frontend.tags.tags_view', compact('products', 'categories'));
    }

    public function subCatWiseProduct($subCat_id, $slug)
    {
        $products = Product::where('status', 1)->where('subCategory_id', $subCat_id)->orderBy('id', 'DESC')->paginate(6);

        $categories = Category::orderBy('category_name_ja', 'ASC')->get();

        return view('frontend.product.subCategory_view', compact('products', 'categories'));
    }

    public function subSubCatWiseProduct($subSubCat_id, $slug)
    {
        $products = Product::where('status', 1)->where('subSubCategory_id', $subSubCat_id)->orderBy('id', 'DESC')->paginate(6);

        $categories = Category::orderBy('category_name_ja', 'ASC')->get();

        return view('frontend.product.sub_subCategory_view', compact('products', 'categories'));
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->resize(300, 300)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('user-profile', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
