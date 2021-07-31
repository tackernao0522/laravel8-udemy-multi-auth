@extends('frontend.main_master')

@section('title')
キャンセル商品リスト
@endsection

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')

            <div class="col-md-10" style="margin-top: 50px">
                <div class="table-responsive">
                    <table class="table" style="display: block; overflow-x: scroll; white-space: nowrap; -webkit-overflow-scrolling: touch">
                        <tbody>
                            <tr style="background: #e2e2e2">
                                <td class="col-md-3">
                                    <label for="">注文日</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">合計金額</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">決済方法</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">請求番号</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">ステータス</label>
                                </td>

                                <td class="col-md-1">
                                    <label for="">詳細／領収書</label>
                                </td>

                                @forelse($orders as $order)
                            <tr>
                                <td class="col-md-3">
                                    <label for="">{{ $order->order_date }}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">¥{{ number_format($order->amount) }}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">{{ $order->payment_method }}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">{{ $order->invoice_no }}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">
                                        <span class="badge badge-pill badge-warning" style="background: #418D89">{{ $order->status }}</span>
                                    </label>
                                </td>

                                <td class="col-md-1">
                                    <div style="display: flex">
                                        <a href="{{ url('user/order_details/' . $order->id) }}" class="btn btn-sm btn-primary" style="margin-right: 5px"><i class="fa fa-eye"></i>詳細</a>
                                        <a target="_blank" href="{{ url('user/invoice_download/' . $order->id) }}" class="btn btn-sm btn-danger" style="color: white"><i class="fa fa-download"></i>領収書</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <h2 class="text-danger">キャンセルした商品はありません。</h2>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div> <!-- end col-md-8 -->
        </div> <!-- end row -->
    </div>
</div>
@endsection
