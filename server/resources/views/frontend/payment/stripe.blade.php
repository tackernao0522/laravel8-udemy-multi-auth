@extends('frontend.main_master')

@section('title')
Stipeによる決済
@endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Top</a></li>
                <li class='active'>Strip</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-6">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">お支払い額</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
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
                </div> <!-- end col-md-6 -->

                <div class="col-md-6">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">お支払い方法</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Stripe</label>
                                        <img src="{{ asset('frontend/assets/images/payments/4.png') }}" alt="">
                                        <input type="radio" name="payment_method" value="stripe">
                                    </div> <!-- end col-md-4 -->

                                    <div class="col-md-4">
                                        <label for="">カード</label>
                                        <img src="{{ asset('frontend/assets/images/payments/3.png') }}" alt="">
                                        <input type="radio" name="payment_method" value="card">
                                    </div> <!-- end col-md-4 -->

                                    <div class="col-md-4">
                                        <label for="">キャッシュ</label>
                                        <img src="{{ asset('frontend/assets/images/payments/2.png') }}" alt="">
                                        <input type="radio" name="payment_method" value="cash">
                                    </div> <!-- end col-md-4 -->
                                </div> <!-- end row -->
                                <hr>
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">決済へ進む</button>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div> <!-- end col-md-6 -->
                </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->

        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection
