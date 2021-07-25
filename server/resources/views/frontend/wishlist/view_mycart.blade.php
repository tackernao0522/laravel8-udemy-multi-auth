@extends('frontend.main_master')

@section('title')
@if(session()->get('language') == 'english') My Cart Page @else マイカート @endif
@endsection

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Top</a></li>
                <li class='active'>マイカート</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-romove item">@if(session()->get('language') == 'english') Image @else 商品画像 @endif</th>
                                    <th class="cart-description item">@if(session()->get('language') == 'english') Name @else 商品名 @endif</th>
                                    <th class="cart-product-name item">@if(session()->get('language') == 'english') Color @else カラー @endif</th>
                                    <th class="cart-edit item">@if(session()->get('language') == 'english') Size @else サイズ @endif</th>
                                    <th class="cart-qty item">@if(session()->get('language') == 'english') Quantity @else 数量 @endif</th>
                                    <th class="cart-sub-total item">@if(session()->get('language') == 'english') Subtotal @else 小計 @endif</th>
                                    <th class="cart-total last-item">@if(session()->get('language') == 'english') Remove @else 削除 @endif</th>
                                </tr>
                            </thead><!-- /thead -->

                            <tbody id="cartPage">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 estimate-ship-tax">

                </div>

                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    @if(Session::has('coupon'))
                    @else
                    <table class="table" id="couponField">
                        <thead>
                            <tr>
                                <th>
                                    <span class="estimate-title">@if(session()->get('language') == 'english')Discount Code @else クーポンコード @endif</span>
                                    <p>@if(session()->get('language') == 'english')Enter your coupon code if you have one.. @else クーポンコードをお持ちの場合は入力してください。 @endif</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control unicase-form-control text-input" placeholder="You Coupon.." id="coupon_name">
                                    </div>
                                    <div class="clearfix pull-right">
                                        <button type="submit" class="btn-upper btn btn-primary" onclick="applyCoupon()">@if(session()->get('language') == 'english') APPLY COUPON @else クーポンを適用 @endif</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                    @endif
                </div><!-- /.estimate-ship-tax -->

                <div class="col-md-4 col-sm-12 cart-shopping-total">
                    <table class="table">
                        <thead id="couponCalField">

                        </thead><!-- /thead -->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="cart-checkout-btn pull-right">
                                        <a href="{{ route('checkout') }}" type="submit" class="btn btn-primary checkout-btn">@if(session()->get('language') == 'english') PROCCED TO CHEKOUT @else チェックアウトに進む @endif</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.cart-shopping-total -->

            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        <br>
        @include('frontend.body.brands')
    </div>
</div>
@endsection
