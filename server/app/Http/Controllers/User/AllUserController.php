<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class AllUserController extends Controller
{
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->get();

        return view('frontend.user.order.order_view', compact('orders'));
    }

    public function orderDetails($order_id)
    {
        $order = Order::with('division', 'district', 'town', 'user')->where('id', $order_id)
            ->where('user_id', Auth::id())
            ->first();

        $orderItems = OrderItem::with('product')->where('order_id', $order_id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('frontend.user.order.order_details', compact(
            'order',
            'orderItems',
        ));
    }
}
