@extends('frontend.main_master')

@section('title')
@if(session()->get('language') == 'english') {{ $blogPost->post_title_en }} @else {{ $blogPost->post_title_ja }} @endif
@endsection

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>@if(session()->get('language') == 'english') {{ $blogPost->post_title_en }} @else {{ $blogPost->post_title_ja }} @endif</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="blog-page">
                <div class="col-md-9">
                    <div class="blog-post wow fadeInUp">
                        <img class="img-responsive" src="{{ Storage::disk('s3')->url("blogs/{$blogPost->post_image}") }}" alt="">
                        <h1>@if(session()->get('language') == 'english') {{ $blogPost->post_title_en }} @else {{ $blogPost->post_title_ja }} @endif</h1>
                        <span class="date-time">{{ Carbon\Carbon::parse($blogPost->created_at)->diffForHumans() }}</span>
                        <p>@if(session()->get('language') == 'english') {!! $blogPost->post_details_en !!} @else {!! $blogPost->post_details_ja !!} @endif</p>
                        <div class="social-media">
                            <span>share post:</span>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href=""><i class="fa fa-rss"></i></a>
                            <a href="" class="hidden-xs"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                    <div class="blog-write-comment outer-bottom-xs outer-top-xs">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Leave A Comment</h4>
                            </div>
                            <div class="col-md-4">
                                <form class="register-form" role="form">
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
                                        <input type="email" class="form-control unicase-form-control text-input" id="exampleInputName" placeholder="">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form class="register-form" role="form">
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                        <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form class="register-form" role="form">
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputTitle">Title <span>*</span></label>
                                        <input type="email" class="form-control unicase-form-control text-input" id="exampleInputTitle" placeholder="">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <form class="register-form" role="form">
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputComments">Your Comments <span>*</span></label>
                                        <textarea class="form-control unicase-form-control" id="exampleInputComments"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12 outer-bottom-small m-t-20">
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Submit Comment</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 sidebar">



                    <div class="sidebar-module-container">
                        <div class="search-area outer-bottom-small">
                            <form>
                                <div class="control-group">
                                    <input placeholder="Type to search" class="search-field">
                                    <a href="#" class="search-button"></a>
                                </div>
                            </form>
                        </div>

                        <div class="home-banner outer-top-n outer-bottom-xs">
                            <img src="{{ asset('frontend/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                        </div>
                        <!-- ==============================================CATEGORY============================================== -->
                        <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                            <h3 class="section-title">@if(session()->get('language') == 'english') Blog Category @else ブログカテゴリー @endif</h3>
                            <div class="sidebar-widget-body m-t-10">
                                <div class="accordion">
                                    <div class="accordion-group">
                                        @foreach($blogCategories as $category)
                                        <ul class="list-group">
                                            <li class="list-group-item">@if(session()->get('language') == 'english') {{ $category->blog_category_name_en }} @else {{ $category->blog_category_name_ja }} @endif</li>
                                        </ul>
                                        @endforeach
                                    </div><!-- /.accordion-group -->
                                </div><!-- /.accordion -->
                            </div><!-- /.sidebar-widget-body -->
                        </div><!-- /.sidebar-widget -->
                        <!-- ============================================== CATEGORY : END ============================================== -->

                        <!-- ============================================== PRODUCT TAGS ============================================== -->
                        <div class="sidebar-widget product-tag wow fadeInUp">
                            <h3 class="section-title">@if(session()->get('language') == 'english') Product tags @else 商品タグ @endif</h3>
                            <div class="sidebar-widget-body outer-top-xs">
                                <div class="tag-list">
                                    <a class="item" title="Phone" href="category.html">Phone</a>
                                    <a class="item active" title="Vest" href="category.html">Vest</a>
                                    <a class="item" title="Smartphone" href="category.html">Smartphone</a>
                                    <a class="item" title="Furniture" href="category.html">Furniture</a>
                                    <a class="item" title="T-shirt" href="category.html">T-shirt</a>
                                    <a class="item" title="Sweatpants" href="category.html">Sweatpants</a>
                                    <a class="item" title="Sneaker" href="category.html">Sneaker</a>
                                    <a class="item" title="Toys" href="category.html">Toys</a>
                                    <a class="item" title="Rose" href="category.html">Rose</a>
                                </div><!-- /.tag-list -->
                            </div><!-- /.sidebar-widget-body -->
                        </div><!-- /.sidebar-widget -->
                        <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
