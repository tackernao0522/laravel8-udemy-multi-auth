<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function couponView()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();

        return view('backend.coupon.view_coupon', compact('coupons'));
    }

    public function couponStore(Request $request)
    {
        $validatedData = $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required|integer',
            'coupon_validity' => 'required',
        ], [
            'coupon_name.required' => 'クーポン名は必須です。',
            'coupon_discount.required' => '割引率は必須です。',
            'coupon_discount.integer' => '割引率は半角数字を指定してください。',
            'coupon_validity.required' => '有効期限は必須です。',
        ]);

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'クーポンを作成しました。(Coupon Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }
}
