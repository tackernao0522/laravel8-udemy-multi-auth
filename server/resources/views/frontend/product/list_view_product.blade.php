@foreach($products as $product)
<div class="category-product-inner wow fadeInUp">
    <div class="products">
        <div class="product-list product">
            <div class="row product-list-row">
                <div class="col col-sm-4 col-lg-4">
                    <div class="product-image">
                        <div class="image"> <img src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""> </div>
                    </div>
                    <!-- /.product-image -->
                    @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount / $product->selling_price) * 100;
                    @endphp
                </div>
                <!-- /.col -->
                <div class="col col-sm-8 col-lg-8">
                    <div class="product-info">
                        @if(session()->get('language') == 'japanese')
                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_ja) }}">{!! nl2br(e(Str::limit($product->product_name_ja, 50))) !!}</a></h3>
                        @else
                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">{!! nl2br(e(Str::limit($product->product_name_en, 50))) !!}</a></h3>
                        @endif
                        <div class="rating rateit-small"></div>
                        @if ($product->discount_price == NULL)
                        <div class="product-price"> <span class="price">¥ {{ $product->selling_price }}</span></div>
                        @else
                        <div class="product-price"> <span class="price">¥ {{ $product->discount_price }}</span> <span class="price-before-discount">¥ {{ $product->selling_price }}</span> </div>
                        @endif
                        <!-- /.product-price -->
                        <div class="description m-t-10">
                            @if(session()->get('language') == 'english') {{ $product->short_descp_en }} @else {{ $product->short_descp_ja }} @endif
                        </div>
                        <div class="cart clearfix animate-effect">
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                        <button class="btn btn-primary cart-btn" type="button">@if(session()->get('language') == 'english') Add to cart @else カートに入れる @endif</button>
                                    </li>
                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                </ul>
                            </div>
                            <!-- /.action -->
                        </div>
                        <!-- /.cart -->
                    </div>
                    <!-- /.product-info -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.product-list-row -->
            @if ($product->discount_price == NULL)
            <div class="tag new"><span>@if(session()->get('language') == 'english') new @else 新着 @endif</span></div>
            @else
            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
            @endif
        </div>
        <!-- /.product-list -->
    </div>
    <!-- /.products -->
</div>
<!-- /.category-product-inner -->
<!-- End Product List View -->
@endforeach