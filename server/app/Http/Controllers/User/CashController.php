<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;

class CashController extends Controller
{
    public function cashOrder(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = floor((int) Cart::total());
        }

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'town_id' => $request->town_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,
            'payment_type' => '代引き配送',
            'payment_method' => '代引き配送',
            'currency' => 'JPY',
            'amount' => $total_amount,
            'invoice_no' => 'FUN' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('Y年n月j日'),
            'order_month' => Carbon::now()->format('n月'),
            'order_year' => Carbon::now()->format('Y年'),
            'status' => 'pending',
            'created_at' => Carbon::now(),
        ]);

        // Start Send Email
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
        ];

        Mail::to($request->email)->send(new OrderMail($data));
        // End Send Email(php artisan make:mail OrderMail)

        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification = array(
            'message' => 'ご注文が完了しました。',
            'alert-type' => 'success',
        );

        return redirect()->route('dashboard')
            ->with($notification);
    }
}
