@extends('frontend.main_master')

@section('title')
返品依頼リスト
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

                                <td class="col-md-1">
                                    <label for="">オーダー番号</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">オーダーステータス</label>
                                </td>

                                @foreach($orders as $order)
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
                                    <label for="">{{ $order->order_number }}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">
                                        @if($order->return_order == 0)
                                        <span class="badge badge-pill badge-warning" style="background: #418DB9">返品依頼商品はありません。</span>
                                        @elseif($order->return_order == 1)
                                        <span class="badge badge-pill badge-warning" style="background: #800000">保留中</span>
                                        <span class="badge badge-pill badge-warning" style="background: red">返品依頼済</span>
                                        @elseif($order->return_order == 2)
                                        <span class="badge badge-pill badge-warning" style="background: #008000">完了</span>
                                        @endif
                                    </label>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- end col-md-8 -->
        </div> <!-- end row -->
    </div>
</div>
@endsection
