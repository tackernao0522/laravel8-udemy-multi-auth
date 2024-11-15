@extends('frontend.main_master')

@section('title')
購入商品詳細
@endsection

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')

            <div class="col-md-5" style="margin-top: 20px">
                <div class="card">
                    <div class="card-header">
                        <h4>お届け先詳細</h4>
                    </div>
                    <hr>
                    <div class="cart-body" style="background: #E9EBEC">
                        <table class="table" style="display: block; overflow-x: scroll; white-space: nowrap; -webkit-overflow-scrolling: touch">
                            <tr>
                                <th>お名前 : </th>
                                <th>{{ $order->name }} 様</th>
                            </tr>

                            <tr>
                                <th>電話番号 : </th>
                                <th>{{ $order->phone }}</th>
                            </tr>

                            <tr>
                                <th>メールアドレス : </th>
                                <th>{{ $order->email }}</th>
                            </tr>

                            <tr>
                                <th>郵便番号 : </th>
                                <th>{{ $order->post_code }}</th>
                            </tr>

                            <tr>
                                <th>都道府県 : </th>
                                <th>{{ $order->division->division_name }}</th>
                            </tr>

                            <tr>
                                <th>区市町村 : </th>
                                <th>{{ $order->district->district_name }}</th>
                            </tr>

                            <tr>
                                <th>町名 : </th>
                                <th>{{ $order->town->town_name }}</th>
                            </tr>

                            <tr>
                                <th>丁目・番地等 : </th>
                                <th>{{ $order->notes }}</th>
                            </tr>

                            <tr>
                                <th>購入日 : </th>
                                <th>{{ $order->order_date }}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div> <!-- end col-md-5 -->

            <div class="col-md-5" style="margin-top: 20px">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            購入者詳細
                            <span class="text-danger">購入番号 : {{ $order->invoice_no }}</span>
                        </h4>
                    </div>
                    <hr>
                    <div class="cart-body" style="background: #E9EBEC">
                        <table class="table" style="display: block; overflow-x: scroll; white-space: nowrap; -webkit-overflow-scrolling: touch">
                            <tr>
                                <th>購入者お名前 : </th>
                                <th>{{ $order->user->name }} 様</th>
                            </tr>

                            <tr>
                                <th>購入者電話番号 : </th>
                                <th>{{ $order->user->phone }}</th>
                            </tr>
                            <tr>
                                <th>お支払い方法 : </th>
                                <th>{{ $order->payment_method }}</th>
                            </tr>

                            <tr>
                                <th>Tranx ID : </th>
                                <th>{{ $order->transaction_id }}</th>
                            </tr>

                            <tr>
                                <th>購入番号 : </th>
                                <th class="text-danger">{{ $order->invoice_no }}</th>
                            </tr>

                            <tr>
                                <th>合計支払い額 : </th>
                                <th>¥ {{ number_format($order->amount) }}(税込)</th>
                            </tr>

                            <tr>
                                <th>ステータス : </th>
                                @if($order->status == 'pending')
                                <th><span class="badge badge-pill badge-warning" style="background: #800080">保留中</span></th>
                                @elseif($order->status == 'confirm')
                                <th><span class="badge badge-pill badge-warning" style="background: #0000FF">確認済</span></th>
                                @elseif($order->status == 'processing')
                                <th><span class="badge badge-pill badge-warning" style="background: #FFA500">対応中</span></th>
                                @elseif($order->status == 'picked')
                                <th><span class="badge badge-pill badge-warning" style="background: #808000">発送可能</span></th>
                                @elseif($order->status == 'shipped')
                                <th><span class="badge badge-pill badge-warning" style="background: #808080">発送済</span></th>
                                @elseif($order->status == 'delivered')
                                <th><span class="badge badge-pill badge-warning" style="background: #008000">配達完了</span></th>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
            </div> <!-- 2nd end col-md-5 -->

            <!-- <div class="row"> -->
            <div class="col-md-12 text-center">
                <div class="table-responsive">
                    <table class="table" style="display: block; overflow-x: scroll; white-space: nowrap; -webkit-overflow-scrolling: touch">
                        <tbody>
                            <tr style="background: #e2e2e2">
                                <td class="col-md-1">
                                    <label for="">商品画像</label>
                                </td>

                                <td class="col-md-3">
                                    <label for="">商品名</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">商品番号</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">カラー</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">サイズ</label>
                                </td>

                                <td class="col-md-1">
                                    <label for="">数量</label>
                                </td>

                                <td class="col-md-1">
                                    <label for="">価格</label>
                                </td>

                                <td class="col-md-1">
                                    <label for="">ダウンロード</label>
                                </td>

                                @foreach($orderItems as $item)
                            <tr>
                                <td class="col-md-1">
                                    <label for=""><img src="{{ Storage::disk('s3')->url("products/thambnail/{$item->product->product_thambnail}") }}" height="50px" width="50px"></label>
                                </td>

                                <td class="col-md-3">
                                    <label for="">{{ $item->product->product_name_ja }}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">{{ $item->product->product_code }}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">{{ $item->color }}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">{{ $item->size }}</label>
                                </td>

                                <td class="col-md-1">
                                    <label for="">{{ $item->qty }}</label>
                                </td>

                                <td class="col-md-1">
                                    <label for="">¥ {{ number_format($item->price) }} (¥{{ number_format($item->price * $item->qty) }})(税込)</label>
                                </td>

                                @php
                                $file = App\Models\Product::where('id', $item->product_id)->first();
                                @endphp

                                <td class="col-md-1">
                                    @if($order->status == 'pending' || !($file->digital_file))
                                    <strong>
                                        <span class="badge badge-pill badge-success" style="background: #418DB9;"> No File</span> </strong>

                                    @elseif($order->status == 'confirm')

                                    <a target="_blank" href="{{ Storage::disk('s3')->url("products/pdf/{$file->digital_file}") }}">
                                        <strong>
                                            <span class="badge badge-pill badge-success" style="background: #FF0000;"> ダウンロードする</span> </strong> </a>
                                    @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($order->status !== "delivered")
                @else
                @php
                $order = App\Models\Order::where('id', $order->id)->where('return_reason', '=', NULL)->first();
                @endphp
                @if($order)
                <form action="{{ route('return.order', $order->id) }}" method="POST">
                    @csrf
                    <div class="form-group" align="left">
                        <label for="">返品理由:</label>
                        <textarea name="return_reason" id="" class="form-control" cols="30" rows="05" placeholder="返品理由入力"></textarea>
                    </div>
                    <div align="left" style="margin-bottom: 10px">
                        <button type="submit" class="btn btn-danger">返品依頼</button>
                    </div>
                </form>
                @else
                <div align="left" style="margin-bottom: 10px">
                    <span class="badge badge-pill badge-warning" style="background: red">この商品は返品依頼をしています。</span>
                </div>
                @endif
                @endif
            </div> <!-- end col-md-12 -->
            <!-- </div> END ORDER ITEM ROW -->
        </div> <!-- end row -->
    </div>
</div>
@endsection
