<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{
    public function reviewStore(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // $product = $product->id;

        $validatedData = $request->validate([
            'summary' => 'required',
            'comment' => 'required',
        ]);

        Review::insert([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'summary' => $request->summary,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '管理者の認証待ちです。しばらくお待ちください。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }
}
