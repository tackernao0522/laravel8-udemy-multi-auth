<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Band;
use App\Models\Product;

class ShopController extends Controller
{
    public function shopPage()
    {
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->paginate(3);

        $categories = Category::orderBy('category_name_ja', 'ASC')->get();

        return view('frontend.shop.shop_page', compact('products', 'categories'));
    }
}
