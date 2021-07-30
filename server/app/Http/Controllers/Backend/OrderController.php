<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use PDF;

class OrderController extends Controller
{
    public function pendingOrders()
    {
        $orders = Order::where('status', '保留中')
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

    public function confirmedOrders()
    {
        $orders = Order::where('status', '確認済')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.confirmed_orders', compact('orders'));
    }

    public function processingOrders()
    {
        $orders = Order::where('status', '対応中')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.processing_orders', compact('orders'));
    }

    public function pickedOrders()
    {
        $orders = Order::where('status', '発送可能')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.picked_orders', compact('orders'));
    }

    public function shippedOrders()
    {
        $orders = Order::where('status', '発送済')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.shipped_orders', compact('orders'));
    }

    public function deliveredOrders()
    {
        $orders = Order::where('status', '配達完了')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.delivered_orders', compact('orders'));
    }

    public function cancelOrders()
    {
        $orders = Order::where('status', 'キャンセル')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.cancel_orders', compact('orders'));
    }

    public function pendingToConfirm($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => '確認済',
            'confirmed_date' => Carbon::now()->format('Y年n月j日'),
        ]);

        $notification = array(
            'message' => '確認済にしました。',
            'alert-type' => 'success',
        );

        return redirect()->route('pending-orders')
            ->with($notification);
    }

    public function confirmToProcessing($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => '対応中',
            'processing_date' => Carbon::now()->format('Y年n月j日'),
        ]);

        $notification = array(
            'message' => '対応中にしました。',
            'alert-type' => 'success',
        );

        return redirect()->route('confirmed-orders')
            ->with($notification);
    }

    public function processingToPicked($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => '発送可能',
            'picked_date' => Carbon::now()->format('Y年n月j日'),
        ]);

        $notification = array(
            'message' => '発送可能にしました。',
            'alert-type' => 'success',
        );

        return redirect()->route('processing-orders')
            ->with($notification);
    }

    public function pickedToShipped($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => '発送済',
            'shipped_date' => Carbon::now()->format('Y年n月j日'),
        ]);

        $notification = array(
            'message' => '発送済にしました。',
            'alert-type' => 'success',
        );

        return redirect()->route('picked-orders')
            ->with($notification);
    }

    public function shippedToDelivered($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => '配達完了',
            'delivered_date' => Carbon::now()->format('Y年n月j日'),
        ]);

        $notification = array(
            'message' => '配達完了にしました。',
            'alert-type' => 'success',
        );

        return redirect()->route('shipped-orders')
            ->with($notification);
    }

    public function adminInvoiceDownload($order_id)
    {
        $order = Order::with('division', 'district', 'town', 'user')->where('id', $order_id)->first();

        $orderItems = OrderItem::with('product')->where('order_id', $order_id)
            ->orderBy('id', 'DESC')
            ->get();

        $pdf = PDF::loadView('backend.orders.order_invoice',  compact(
            'order',
            'orderItems',
        ))->setPaper('a4');

        return $pdf->download('invoice.pdf');
    }
}
