@extends('frontend.main_master')

@section('title')
@if(session()->get('language') == 'english') My Checkout @else チェックアウト @endif
@endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

                                        <!-- guest-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle"><b>配送先住所</b></h4>
                                            <form class="register-form" role="form">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>お名前</b> <span>*</span></label>
                                                    <input type="text" name="shipping_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="フルネーム" value="{{ Auth::user()->name }}" required="">
                                                </div> <!-- end form group -->

                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>メールアドレス</b> <span>*</span></label>
                                                    <input type="email" name="shipping_email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="メールアドレス" value="{{ Auth::user()->email }}" required="">
                                                </div> <!-- end form group -->

                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>電話番号</b> <span>*</span></label>
                                                    <input type="text" name="shipping_phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="半角数字ハイフンなし" value="{{ Auth::user()->phone }}" required="">
                                                </div> <!-- end form group -->

                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>郵便番号</b> <span>*</span></label>
                                                    <input type="text" name="post_code" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="半角数字ハイフンなし" value="{{ old('post_code') }}" required="">
                                                </div> <!-- end form group -->
                                        </div>
                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <div class="form-group">
                                                <h5><b>都道府県</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="division_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">都道府県 選択</option>
                                                        @foreach($divisions as $item)
                                                        <option value="{{ $item->id }}" {{ old('division_id') == $item->id ? 'selected': '' }}>{{ $item->division_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('division_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> <!-- end form group -->

                                            <div class="form-group">
                                                <h5><b>区・市・町・村</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="district_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">区・市・町・村 選択</option>

                                                    </select>
                                                    @error('district_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <h5><b>町名</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="town_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">町名 選択</option>

                                                    </select>
                                                    @error('town_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> <!-- end form group -->

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">丁目・番地・マンション名等 <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="notes" cols="30" rows="5" placeholder="丁目・番地・マンション名等">{{ old('notes') }}</textarea>
                                                @error('notes')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- end form group -->

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

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="division_id"]').on('change', function() {
            var division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{ url('/district-get/ajax') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="town_id"]').empty();
                        var d = $('select[name="district_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.district_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

        $('select[name="district_id"]').on('change', function() {
            var district_id = $(this).val();
            if (district_id) {
                $.ajax({
                    url: "{{ url('/town-get/ajax') }}/" + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="town_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="town_id"]').append('<option value="' + value.id + '">' + value.town_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>
@endsection
