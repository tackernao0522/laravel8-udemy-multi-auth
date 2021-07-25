@php
$hot_deals = App\Models\Product::where('hot_deals', 1)
->where('discount_price', '!=', NULL)
->orderBy('id', 'DESC')->limit(3)->get();
@endphp
<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">@if(session()->get('language') == 'english') hot deals @else お買い得品 @endif</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
        @foreach($hot_deals as $product)
        <div class="item">
            <div class="products">
                <div class="hot-deal-wrapper">
                    <div class="image"> <img src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""> </div>

                    @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount / $product->selling_price) * 100;
                    @endphp

                    @if ($product->discount_price == NULL)
                    <div class="sale-offer-tag"><span>@if(session()->get('language') == 'english') new @else 新着 @endif<br>@if(session()->get('language') == 'english') HOT!! @else 注目! @endif</span></div>
                    @else
                    <div class="sale-offer-tag"><span>{{ round($discount) }}%<br>
                            off</span></div>
                    @endif
                    <div class="timing-wrapper">
                        <div class="box-wrapper">
                            <div class="date box"> <span class="key">120</span> <span class="value">DAYS</span> </div>
                        </div>
                        <div class="box-wrapper">
                            <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                        </div>
                        <div class="box-wrapper">
                            <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                        </div>
                        <div class="box-wrapper hidden-md">
                            <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
                        </div>
                    </div>
                </div>
                <!-- /.hot-deal-wrapper -->

                <div class="product-info text-left m-t-20">
                    @if(session()->get('language') == 'japanese')
                    <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_ja) }}">{{ $product->product_name_ja }}</a></h3>
                    @else
                    <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">{{ $product->product_name_en }}</a></h3>
                    @endif
                    <div class="rating rateit-small"></div>
                    @if ($product->discount_price == NULL)
                    <div class="product-price"> <span class="price">¥ {{ $product->selling_price }}</span> </div>
                    @else
                    <div class="product-price"> <span class="price">¥ {{ $product->discount_price }}</span> <span class="price-before-discount">¥ {{ $product->selling_price }}</span> </div>
                    @endif
                    <!-- /.product-price -->

                </div>
                <!-- /.product-info -->

                <div class="cart clearfix animate-effect">
                    <div class="action">
                        <div class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" type="button">@if(session()->get('language') == 'english') Add to cart @else カートに入れる @endif</button>
                        </div>
                    </div>
                    <!-- /.action -->
                </div>
                <!-- /.cart -->
            </div>
        </div>
        @endforeach
        <!-- end hot deals foreach -->
    </div>
    <!-- /.sidebar-widget -->
</div>
