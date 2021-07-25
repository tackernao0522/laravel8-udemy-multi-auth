@extends('frontend.main_master')

@section('title')
@if(session()->get('language') == 'english') My Checkout @else チェックアウト @endif
@endsection

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Top</a></li>
                <li class='active'>チェックアウト</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <!-- panel-heading -->

                            <!-- panel-heading -->

                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">

                                        <!-- guest-login -->
                                        <div class="col-md-6 col-sm-6 guest-login">
                                            <h4 class="checkout-subtitle">Guest or Register Login</h4>
                                            <p class="text title-tag-line">Register with us for future convenience:</p>

                                            <!-- radio-form  -->
                                            <form class="register-form" role="form">
                                                <div class="radio radio-checkout-unicase">
                                                    <input id="guest" type="radio" name="text" value="guest" checked>
                                                    <label class="radio-button guest-check" for="guest">Checkout as Guest</label>
                                                    <br>
                                                    <input id="register" type="radio" name="text" value="register">
                                                    <label class="radio-button" for="register">Register</label>
                                                </div>
                                            </form>
                                            <!-- radio-form  -->

                                            <h4 class="checkout-subtitle outer-top-vs">Register and save time</h4>
                                            <p class="text title-tag-line ">Register with us for future convenience:</p>

                                            <ul class="text instruction inner-bottom-30">
                                                <li class="save-time-reg">- Fast and easy check out</li>
                                                <li>- Easy access to your order history and status</li>
                                            </ul>

                                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button checkout-continue ">Continue</button>
                                        </div>
                                        <!-- guest-login -->

                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle">Already registered?</h4>
                                            <p class="text title-tag-line">Please log in below:</p>
                                            <form class="register-form" role="form">
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                                    <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                                                    <input type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" placeholder="">
                                                    <a href="#" class="forgot-password">Forgot your Password?</a>
                                                </div>
                                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                                            </form>
                                        </div>
                                        <!-- already-registered-login -->

                                    </div>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <!-- End checkout-step-01  -->
                    </div><!-- /.checkout-steps -->
                </div>
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">決済内訳</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach($carts as $item)
                                        <li>
                                            <strong>商品画像: </strong>
                                            <img src="{{ Storage::disk('s3')->url("products/thambnail/{$item->options->image}") }}" style="height: 50px; width: 50px">
                                        </li>
                                        <li>
                                            <strong>数量: </strong>
                                            ( {{ $item->qty }} )
                                            <strong>カラー: </strong>
                                            {{ $item->options->color }}
                                            <strong>サイズ: </strong>
                                            {{ $item->options->size }}
                                        </li>
                                        @endforeach
                                        <hr>
                                        <li>
                                            @if(Session::has('coupon'))
                                            <strong>小計: </strong> ¥{{ number_format($cartTotal) }}(税込)
                                            <hr>
                                            <strong>クーポン名: </strong> {{ session()->get('coupon')['coupon_name'] }}
                                            ( {{ session()->get('coupon')['coupon_discount'] }} % )
                                            <hr>
                                            <strong>クーポン割引: </strong> ¥{{ number_format(session()->get('coupon')['discount_amount']) }}
                                            <hr>
                                            <strong>合計: </strong> ¥{{ number_format(session()->get('coupon')['total_amount']) }}(税込)
                                            <hr>
                                            @else
                                            <strong>小計: </strong> ¥{{ number_format($cartTotal) }}(税込)
                                            <hr>
                                            <strong>合計: </strong> ¥{{ number_format($cartTotal) }}(税込)
                                            <hr>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->

        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection
