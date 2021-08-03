@extends('frontend.main_master')

@section('title')
購入リスト
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
                                    <label for="">
                                        @if($order->status == 'pending')
                                        <span class="badge badge-pill badge-warning" style="background: #800080">保留中</span>
                                        @elseif($order->status == 'confirm')
                                        <span class="badge badge-pill badge-warning" style="background: #0000FF">確認済</span>
                                        @elseif($order->status == 'processing')
                                        <span class="badge badge-pill badge-warning" style="background: #FFA500">対応中</span>
                                        @elseif($order->status == 'picked')
                                        <span class="badge badge-pill badge-warning" style="background: #808000">発送可能</span>
                                        @elseif($order->status == 'shipped')
                                        <span class="badge badge-pill badge-warning" style="background: #808080">発送済</span>
                                        @elseif($order->status == 'delivered')
                                        <span class="badge badge-pill badge-warning" style="background: #008000">配達完了</span>
                                        @else
                                        <span class="badge badge-pill badge-warning" style="background: #FF0000">キャンセル</span>
                                        @endif
                                    </label>
                                </td>

                                <td class="col-md-1">
                                    <div style="display: flex">
                                        <a href="{{ url('user/order_details/' . $order->id) }}" class="btn btn-sm btn-primary" style="margin-right: 5px"><i class="fa fa-eye"></i>詳細</a>
                                        <a target="_blank" href="{{ url('user/invoice_download/' . $order->id) }}" class="btn btn-sm btn-danger" style="color: white"><i class="fa fa-download"></i>領収書</a>
                                    </div>
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
