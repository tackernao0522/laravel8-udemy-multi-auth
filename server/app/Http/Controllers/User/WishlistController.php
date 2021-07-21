<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function viewWishlist()
    {
        return view('frontend.wishlist.view_wishlist');
    }
}
