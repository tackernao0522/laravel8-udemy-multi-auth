<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="icon fa fa-user"></i>@if(session()->get('language') == 'english') My Account @else マイアカウント @endif</a></li>
                        <li><a href="{{ route('wishlist') }}"><i class="icon fa fa-heart"></i>@if(session()->get('language') == 'english') Wishlist @else ウイッシュリスト @endif</a></li>
                        <li><a href="{{ route('mycart') }}"><i class="icon fa fa-shopping-cart"></i>@if(session()->get('language') == 'english') My Cart @else マイカート @endif</a></li>
                        <li><a href="{{ route('checkout') }}"><i class="icon fa fa-check"></i>@if(session()->get('language') == 'english') Checkout @else チェックアウト @endif</a></li>
                        <li><a href="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ordertracking"><i class="icon fa fa-check" style="margin-top: 5px"></i>@if(session()->get('language') == 'english') Order Tracking @else オーダー追跡 @endif</a></li>
                        @auth
                        <li><a href="{{ route('dashboard') }}"><i class="icon fa fa-user"></i>@if(session()->get('language') == 'english') User Profile @else ユーザープロフィール @endif</a></li>
                        @else
                        <li><a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>@if(session()->get('language') == 'english') Login/Register @else ログイン/新規登録 @endif</a></li>
                        @endauth
                    </ul>
                </div>
                <!-- /.cnt-account -->

                <div class="cnt-block">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">USD</a></li>
                                <li><a href="#">INR</a></li>
                                <li><a href="#">GBP</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">@if(session()->get('language') == 'english') Language(言語) @else 言語(Language) @endif </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @if (session()->get('language') == 'english')
                                <li><a href="{{ route('japanese.language') }}">日本語</a></li>
                                @else
                                <li><a href="{{ route('english.language') }}">English</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                    <!-- /.list-unstyled -->
                </div>
                <!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div>
            <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    @php
                    $setting = App\Models\SiteSetting::find(1);
                    @endphp
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo"> <a href="{{ url('/') }}"> <img src="{{ Storage::disk('s3')->url("siteLogo/{$setting->logo}") }}" alt="logo"> </a> </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form method="POST" action="{{ route('product.search') }}">
                            @csrf
                            <div class="control-group">
                                <ul class="categories-filter animate-dropdown">
                                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="category.html">@if(session()->get('language') == 'english') Categories @else カテゴリー @endif<b class="caret"></b></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li class="menu-header">Computer</li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <input class="search-field" name="search" id="search" placeholder="Search here..." />
                                <button class="search-button" type="submit"></button>
                            </div>
                        </form>
                    </div>
                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                <div class="basket-item-count"><span class="count" id="cartQty"> </span></div>
                                <div class="total-price-basket"> <span class="lbl">@if(session()->get('language') == 'english') cart @else カート @endif -</span>
                                    <span class="total-price"> <span class="sign"></span>
                                        <span class="value" id="cartSubTotal"> </span> </span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!-- Mini Cart Start with Ajax -->
                                <div id="miniCart">

                                </div>
                                <!-- End Mini Cart Start with Ajax -->
                                <div class="clearfix cart-total">
                                    <div class="pull-right"> <span class="text">@if(session()->get('language') == 'english') Grand Total : @else 合計 : @endif</span>
                                        <span class='price' id="cartSubTotal"> </span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">@if(session()->get('language') == 'english') Checkout @else チェックアウト @endif</a>
                                </div>
                                <!-- /.cart-total-->

                            </li>
                        </ul>
                        <!-- /.dropdown-menu-->
                    </div>
                    <!-- /.dropdown-cart -->

                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"> <a href="{{ url('/') }}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">@if(session()->get('language') == 'english') Top @else トップ @endif</a> </li>

                                <!-- Get Category Table Data -->
                                @php
                                $categories = App\Models\Category::orderBy('category_name_ja','ASC')->get();
                                @endphp

                                @foreach($categories as $category)
                                <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">@if(session()->get('language') == 'english') {{ $category->category_name_en }} @else {{ $category->category_name_ja }} @endif</a>
                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content ">
                                                <div class="row">
                                                    <!-- Get SubCategory Table Data -->
                                                    @php
                                                    $subCategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subCategory_name_ja','ASC')->get();
                                                    @endphp

                                                    @foreach($subCategories as $subCategory)
                                                    <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                        @if(session()->get('language') == 'english')
                                                        <a href="{{ url('subCategory/product/' . $subCategory->id . '/' . $subCategory->subCategory_slug_en) }}">
                                                            <h2 class="title">{{ $subCategory->subCategory_name_en }}</h2>
                                                        </a>
                                                        @else
                                                        <a href="{{ url('subCategory/product/' . $subCategory->id . '/' . $subCategory->subCategory_slug_ja) }}">
                                                            <h2 class="title">{{ $subCategory->subCategory_name_ja }}</h2>
                                                        </a>
                                                        @endif

                                                        <!-- Get SubSubCategory Table Data -->
                                                        @php
                                                        $subSubCategories = App\Models\SubSubCategory::where('subCategory_id',$subCategory->id)->orderBy('subSubCategory_name_ja','ASC')->get();
                                                        @endphp

                                                        @foreach($subSubCategories as $subSubCategory)
                                                        <ul class="links">
                                                            @if(session()->get('language') == 'english')
                                                            <li><a href="{{ url('subSubCategory/product/' . $subSubCategory->id . '/' . $subSubCategory->subSubCategory_slug_en) }}">{{ $subSubCategory->subSubCategory_name_en }}</a></li>
                                                            @else
                                                            <li><a href="{{ url('subSubCategory/product/' . $subSubCategory->id . '/' . $subSubCategory->subSubCategory_slug_ja) }}">{{ $subSubCategory->subSubCategory_name_ja }}</a></li>
                                                            @endif
                                                        </ul>
                                                        @endforeach
                                                        <!-- end SubSubCategoy Foreach -->
                                                    </div>
                                                    <!-- /.col -->
                                                    @endforeach
                                                    <!-- end SubCategoy Foreach -->

                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{ asset('frontend/assets/images/banners/top-menu-banner.jpg') }}" alt=""> </div>
                                                    <!-- /.yamm-content -->
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                @endforeach
                                <!-- end Category Foreach -->
                                <li class="dropdown  navbar-right special-menu"> <a href="#">@if(session()->get('language') == 'english') Todays offer @else 今日の特別セール @endif</a> </li>
                                <li class="dropdown  navbar-right special-menu"> <a href="{{ route('home.blog') }}">@if(session()->get('language') == 'english') Blog @else ブログ @endif</a> </li>
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

    <!-- Order Tracking Modal -->
    <div class="modal fade" id="ordertracking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@if(session()->get('language') == 'english') Track Your Order @else オーダー追跡 @endif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('order.tracking') }}">
                        @csrf
                        <div class="modal-body">
                            <label for="">@if(session()->get('language') == 'english') Invoice Code @else 請求番号 @endif</label>
                            <input type="text" name="code" required="" class="form-control" placeholder="オーダー追跡したい請求番号入力" value="{{ old('code') }}">
                        </div>

                        <button type="submit" class="btn btn-danger" style="margin-left: 15px">@if(session()->get('language') == 'english') Track Now @else 追跡する @endif</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
