@extends('frontend.main_master')

@section('title')
購入商品詳細
@endsection

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>配送詳細</h4>
                    </div>
                    <hr>
                    <div class="cart-body" style="background: #E9EBEC">
                        <table class="table">
                            <tr>
                                <th>名前 : </th>
                                <th>{{ $order->name }}</th>
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
                                <th>町名 : </th>
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

        </div> <!-- end row -->
    </div>
</div>
@endsection
