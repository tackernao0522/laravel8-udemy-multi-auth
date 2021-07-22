<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function viewWishlist()
    {
        return view('frontend.wishlist.view_wishlist');
    }

    public function getWishlistProduct()
    {
        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();

        return response()->json($wishlist);
    }

    public function removeWishlistProduct($id)
    {
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();

        return response()->json(['success' => 'ウィッシュリストから商品を削除しました。']);
    }
}
