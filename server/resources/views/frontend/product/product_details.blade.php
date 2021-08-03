@extends('frontend.main_master')

@section('title')
@if(session()->get('language') == 'english') {{ $product->product_name_en }} @else {{ $product->product_name_ja }} @endif
@if(session()->get('language') == 'english') Product Details @else 商品の詳細 @endif
@endsection

@section('content')
<!-- ===== ======== HEADER : END ============================================== -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li><a href="#">Clothing</a></li>
                <li class='active'>Floral Print Buttoned</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>
            <div class='col-md-3 sidebar'>
                <div class="sidebar-module-container">
                    <div class="home-banner outer-top-n">
                        <img src="{{ asset('frontend/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                    </div>

                    <!-- ============================================== HOT DEALS ============================================== -->
                    @include('frontend.common.hot_deals')
                    <!-- ============================================== HOT DEALS: END ============================================== -->

                    <!-- ============================================== NEWSLETTER ============================================== -->
                    <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
                        <h3 class="section-title">Newsletters</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <p>Sign Up for Our Newsletter!</p>
                            <form>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
                                </div>
                                <button class="btn btn-primary">Subscribe</button>
                            </form>
                        </div><!-- /.sidebar-widget-body -->
                    </div><!-- /.sidebar-widget -->
                    <!-- ============================================== NEWSLETTER: END ============================================== -->

                    <!-- ============================================== Testimonials============================================== -->
                    <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
                        <div id="advertisement" class="advertisement">
                            <div class="item">
                                <div class="avatar"><img src="{{ asset('frontend/assets/images/testimonials/member1.png') }}" alt="Image"></div>
                                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">John Doe <span>Abc Company</span> </div><!-- /.container-fluid -->
                            </div><!-- /.item -->

                            <div class="item">
                                <div class="avatar"><img src="{{ asset('frontend/assets/images/testimonials/member3.png') }}" alt="Image"></div>
                                <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                            </div><!-- /.item -->

                            <div class="item">
                                <div class="avatar"><img src="{{ asset('frontend/assets/images/testimonials/member2.png') }}" alt="Image"></div>
                                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div><!-- /.container-fluid -->
                            </div><!-- /.item -->

                        </div><!-- /.owl-carousel -->
                    </div>

                    <!-- ============================================== Testimonials: END ============================================== -->



                </div>
            </div><!-- /.sidebar -->
            <div class='col-md-9'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">

                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">
                                    @foreach($multiImage as $img)
                                    <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                        <a data-lightbox="image-1" data-title="Gallery" href="{{ Storage::disk('s3')->url("products/multi-image/{$img->photo_name}") }}">
                                            <img class="img-responsive" alt="" src="{{ Storage::disk('s3')->url("products/multi-image/{$img->photo_name}") }}" data-echo="{{ Storage::disk('s3')->url("products/multi-image/{$img->photo_name}") }}">
                                        </a>
                                    </div><!-- /.single-product-gallery-item -->
                                    @endforeach
                                </div><!-- /.single-product-slider -->

                                <div class="single-product-gallery-thumbs gallery-thumbs">
                                    <div id="owl-single-product-thumbnails">
                                        @foreach($multiImage as $img)
                                        <div class="item">
                                            <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide{{ $img->id }}">
                                                <img class="img-responsive" width="85" alt="" src="{{ Storage::disk('s3')->url("products/multi-image/{$img->photo_name}") }}" data-echo="{{ Storage::disk('s3')->url("products/multi-image/{$img->photo_name}") }}">
                                            </a>
                                        </div>
                                        @endforeach
                                    </div><!-- /#owl-single-product-thumbnails -->
                                </div><!-- /.gallery-thumbs -->

                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                <h1 class="name" id="pname">@if(session()->get('language') == 'english') {{ $product->product_name_en }} @else {{ $product->product_name_ja }} @endif</h1>

                                <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="rating rateit-small"></div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="reviews">
                                                <a href="#" class="lnk">(13 Reviews)</a>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.rating-reviews -->

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">Availability :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span class="value">In Stock</span>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.stock-container -->

                                <div class="description-container m-t-20">
                                    @if(session()->get('language') == 'english') {{ $product->short_descp_en }} @else {{ $product->short_descp_ja }} @endif
                                </div><!-- /.description-container -->

                                <div class="price-container info-container m-t-20">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                @if ($product->discount_price == NULL)
                                                <span class="price">¥ {{ $product->selling_price }}</span>
                                                @else
                                                <span class="price">¥ {{ $product->discount_price }}</span>
                                                <span class="price-strike">¥ {{ $product->selling_price }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="favorite-button m-t-10">
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                                    <i class="fa fa-signal"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.price-container -->

                                <!-- Add Product Color And Size -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="info-title control-label">@if(session()->get('language') == 'english') Choose Color @else カラー選択 @endif <span></span></label>
                                            <select class="form-control unicase-form-control selectpicker" style="display: none;" id="color">
                                                <option selected="" disabled="">--@if(session()->get('language') == 'english') Choose Color @else カラー選択 @endif--</option>
                                                @if(session()->get('language') == 'japanese')
                                                @foreach($product_color_ja as $color)
                                                <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                                @endforeach
                                                @else
                                                @foreach($product_color_en as $color)
                                                <option value="{{ $color }}">{{ ucwords($color)  }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div> <!-- end form group -->
                                    </div> <!-- end col 6 -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            @if($product->product_size_ja == null && $product->product_size_en == null)

                                            @else
                                            <label class="info-title control-label">@if(session()->get('language') == 'english') Choose Size @else サイズ選択 @endif <span></span></label>
                                            <select class="form-control unicase-form-control selectpicker" style="display: none;" id="size">
                                                <option selected="" disabled="">--@if(session()->get('language') == 'english') Choose Size @else サイズ選択 @endif--</option>
                                                @if(session()->get('language') == 'japanese')
                                                @foreach($product_size_ja as $size)
                                                <option value="{{ $size }}">{{ ucwords($size) }}</option>
                                                @endforeach
                                                @else
                                                @foreach($product_size_en as $size)
                                                <option value="{{ $size }}">{{ ucwords($size) }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @endif
                                        </div> <!-- end form group -->
                                    </div> <!-- end col 6 -->
                                </div><!-- /.row -->
                                <!-- End Add Product Color And Size -->

                                <div class="quantity-container info-container">
                                    <div class="row">

                                        <div class="col-sm-2">
                                            <span class="label">@if(session()->get('language') == 'english') Qty : @else 数量 : @endif</span>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="cart-quantity">
                                                <div class="quant-input">
                                                    <div class="arrows">
                                                        <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                                        <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                                    </div>
                                                    <input type="text" id="qty" value="1" min="1">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">

                                        <div class="col-sm-7">
                                            <button type="submit" onclick="addToCart()" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i>@if(session()->get('language') == 'english') ADD TO CART @else カートに入れる @endif</button>
                                        </div>


                                    </div><!-- /.row -->
                                </div><!-- /.quantity-container -->
                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
                </div>

                <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">@if(session()->get('language') == 'english') DESCRIPTION @else 詳細説明 @endif</a></li>
                                <li><a data-toggle="tab" href="#review">@if(session()->get('language') == 'english') REVIEW @else レビュー @endif</a></li>
                                <li><a data-toggle="tab" href="#tags">TAGS</a></li>
                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-9">

                            <div class="tab-content">

                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        <p class="text">
                                            @if(session()->get('language') == 'english') {!! $product->long_descp_en !!} @else {!! $product->long_descp_ja !!} @endif
                                        </p>
                                    </div>
                                </div><!-- /.tab-pane -->

                                <div id="review" class="tab-pane">
                                    <div class="product-tab">

                                        <div class="product-reviews">
                                            <h4 class="title">@if(session()->get('language') == 'english') Customer Reviews @else お客様レビュー @endif</h4>

                                            <div class="reviews">
                                                <div class="review">
                                                    <div class="review-title"><span class="summary">We love this product</span><span class="date"><i class="fa fa-calendar"></i><span>1 days ago</span></span></div>
                                                    <div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit."</div>
                                                </div>

                                            </div><!-- /.reviews -->
                                        </div><!-- /.product-reviews -->

                                        <div class="product-add-review">
                                            <h4 class="title">@if(session()->get('language') == 'english') Write your own review @else レビューを投稿する @endif</h4>
                                            <div class="review-table">

                                            </div><!-- /.review-table -->

                                            <div class="review-form">
                                                @guest
                                                <p><b>@if(session()->get('language') == 'english') For Add Product Review You Need login First @else 製品レビューを投稿するには、ログインする必要があります。 @endif <a href="{{ route('login') }}">@if(session()->get('language') == 'english') Login Here @else ログインはこちら @endif </a></b></p>
                                                @else
                                                <div class="form-container">
                                                    <form role="form" class="cnt-form" method="POST" action="{{ route('review.store', $product->id) }}">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-6">

                                                                <div class="form-group">
                                                                    <label for="exampleInputSummary">@if(session()->get('language') == 'english') Summary @else 概要 @endif <span class="astk">*</span></label>
                                                                    <input type="text" name="summary" class="form-control txt" id="exampleInputSummary" placeholder="" value="{{ old('summary') }}">
                                                                    @error('summary')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div><!-- /.form-group -->
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputReview">@if(session()->get('language') == 'english') Review @else レビュー @endif <span class="astk">*</span></label>
                                                                    <textarea class="form-control txt txt-review" name="comment" id="exampleInputReview" rows="4" placeholder="">{{ old('comment') }}</textarea>
                                                                    @error('comment')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div><!-- /.form-group -->
                                                            </div>
                                                        </div><!-- /.row -->

                                                        <div class="action text-right">
                                                            <button type="submit" class="btn btn-primary btn-upper">@if(session()->get('language') == 'english') SUBMIT REVIEW @else レビューを投稿 @endif</button>
                                                        </div><!-- /.action -->

                                                    </form><!-- /.cnt-form -->
                                                </div><!-- /.form-container -->
                                                @endguest
                                            </div><!-- /.review-form -->

                                        </div><!-- /.product-add-review -->

                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->

                                <div id="tags" class="tab-pane">
                                    <div class="product-tag">

                                        <h4 class="title">Product Tags</h4>
                                        <form role="form" class="form-inline form-cnt">
                                            <div class="form-container">

                                                <div class="form-group">
                                                    <label for="exampleInputTag">Add Your Tags: </label>
                                                    <input type="email" id="exampleInputTag" class="form-control txt">


                                                </div>

                                                <button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
                                            </div><!-- /.form-container -->
                                        </form><!-- /.form-cnt -->

                                        <form role="form" class="form-inline form-cnt">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
                                            </div>
                                        </form><!-- /.form-cnt -->

                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->

                            </div><!-- /.tab-content -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.product-tabs -->

                <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">@if(session()->get('language') == 'english') Related products @else 関連商品 @endif</h3>
                    <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                        @foreach($relatedProduct as $product)
                        <div class="item item-carousel">
                            <div class="products">

                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            @if(session()->get('language') == 'japanese')
                                            <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_ja) }}"><img src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""></a>
                                            @else
                                            <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}"><img src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""></a>
                                            @endif
                                        </div><!-- /.image -->

                                        <div class="tag sale"><span>sale</span></div>
                                    </div><!-- /.product-image -->


                                    <div class="product-info text-left">
                                        @if(session()->get('language') == 'japanese')
                                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_ja) }}">{{ $product->product_name_ja }}</a></h3>
                                        @else
                                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">{{ $product->product_name_en }}</a></h3>
                                        @endif
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>
                                        @if ($product->discount_price == NULL)
                                        <div class="product-price">
                                            <span class="price">
                                                ¥ {{ $product->selling_price }} </span>
                                        </div><!-- /.product-price -->
                                        @else
                                        <div class="product-price">
                                            <span class="price">
                                                ¥ {{ $product->discount_price }} </span>
                                            <span class="price-before-discount">¥ {{ $product->selling_price }}</span>
                                        </div><!-- /.product-price -->
                                        @endif
                                    </div><!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </button>
                                                    <button class="btn btn-primary cart-btn" type="button">@if(session()->get('language') == 'english') Add to cart @else カートに入れる @endif</button>

                                                </li>

                                                <li class="lnk wishlist">
                                                    <a class="add-to-cart" href="detail.html" title="Wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>
                                                </li>

                                                <li class="lnk">
                                                    <a class="add-to-cart" href="detail.html" title="Compare">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- /.action -->
                                    </div><!-- /.cart -->
                                </div><!-- /.product -->

                            </div><!-- /.products -->
                        </div><!-- /.item -->
                        @endforeach
                    </div><!-- /.home-owl-carousel -->
                </section><!-- /.section -->
                <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

            </div><!-- /.col -->
            <div class="clearfix"></div>
        </div><!-- /.row -->
    </div>
</div>
@endsection
