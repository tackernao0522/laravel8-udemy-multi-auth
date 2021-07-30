@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">保留中オーダー詳細</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">保留中オーダー詳細</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>お届け先詳細</strong></h4>
                    </div>
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
                            <th>メール : </th>
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

            <div class="col-md-6 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>購入者詳細</strong><span class="text-danger ml-2" style="font-size: 15px">購入番号 : {{ $order->invoice_no }}</span></h4>
                    </div>
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
                            <th><span class="badge badge-pill badge-warning" style="background: #418D89">{{ $order->status }}</span></th>
                        </tr>

                        <tr>
                            <th></th>
                            <th>
                                @if($order->status == '保留中')
                                <a href="{{ route('pending-confirm', $order->id) }}" class="btn btn-block btn-success" id="confirm">確認済にする</a>
                                @elseif($order->status == '確認済')
                                <a href="{{ route('confirm.processing', $order->id) }}" class="btn btn-block btn-success" id="processing">対応中にする</a>
                                @elseif($order->status == '対応中')
                                <a href="{{ route('processing.picked', $order->id) }}" class="btn btn-block btn-success" id="picked">発送可能にする</a>
                                @elseif($order->status == '発送可能')
                                <a href="{{ route('picked.shippied', $order->id) }}" class="btn btn-block btn-success" id="shipped">発送済にする</a>
                                @elseif($order->status == '発送済')
                                <a href="{{ route('shipped.delivered', $order->id) }}" class="btn btn-block btn-success" id="delivered">配達完了にする</a>
                                @endif
                            </th>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="col-md-12 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                    </div>
                    <table class="table" style="display: block; overflow-x: scroll; white-space: nowrap; -webkit-overflow-scrolling: touch">
                        <tbody>
                            <tr>
                                <td width="10%">
                                    <label for="">商品画像</label>
                                </td>

                                <td width="20%">
                                    <label for="">商品名</label>
                                </td>

                                <td width="10%">
                                    <label for="">商品番号</label>
                                </td>

                                <td width="10%">
                                    <label for="">カラー</label>
                                </td>

                                <td width="10%">
                                    <label for="">サイズ</label>
                                </td>

                                <td width="10%">
                                    <label for="">数量</label>
                                </td>

                                <td width="10%">
                                    <label for="">価格</label>
                                </td>

                                @foreach($orderItems as $item)
                            <tr>
                                <td width="10%">
                                    <label for=""><img src="{{ Storage::disk('s3')->url("products/thambnail/{$item->product->product_thambnail}") }}" height="50px" width="50px"></label>
                                </td>

                                <td width="20%">
                                    <label for="">{{ $item->product->product_name_ja }}</label>
                                </td>

                                <td width="10%">
                                    <label for="">{{ $item->product->product_code }}</label>
                                </td>

                                <td width="10%">
                                    <label for="">{{ $item->color }}</label>
                                </td>

                                <td width="10%">
                                    <label for="">{{ $item->size }}</label>
                                </td>

                                <td width="10%">
                                    <label for="">{{ $item->qty }}</label>
                                </td>

                                <td width="10%">
                                    <label for="">¥ {{ number_format($item->price) }} (¥{{ number_format($item->price * $item->qty) }})(税込)</label>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
