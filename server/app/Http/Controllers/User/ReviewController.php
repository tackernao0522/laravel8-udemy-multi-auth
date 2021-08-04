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

    public function pendingReview()
    {
        $reviews = Review::where('status', 0)->orderBy('id', 'DESC')->get();

        return view('backend.review.pending_review', compact('reviews'));
    }

    public function reviewApprove($id)
    {
        Review::where('id', $id)->update(['status' => 1]);

        $notification = array(
            'message' => 'レビューを承認しました。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function publishReview()
    {
        $reviews = Review::where('status', 1)->orderBy('id', 'DESC')->get();

        return view('backend.review.publish_review', compact('reviews'));
    }

    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        $notification = array(
            'message' => 'レビューID：' . $review->id . 'を削除しました。',
            'alert-type' => 'error',
        );

        return redirect()->back()
            ->with($notification);
    }
}
