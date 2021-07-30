<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function pendingOrders()
    {
        $orders = Order::where('status', '未発送')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.pending_orders', compact('orders'));
    }

    public function pendingOrdersDetails($order_id)
    {
        $order = Order::with('division', 'district', 'town', 'user')
            ->where('id', $order_id)
            ->first();

        $orderItems = OrderItem::with('product')->where('order_id', $order_id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.pending_orders_details', compact(
            'order',
            'orderItems',
        ));
    }
}
