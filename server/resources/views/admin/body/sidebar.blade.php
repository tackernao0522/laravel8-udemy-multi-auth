@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ url('/') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                        <h3><b>Easy</b> Shop</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ ($route == 'dashboard') ? 'active' : '' }}">
                <a href="{{ url('/admin/dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @php
            $brand = (auth()->guard('admin')->user()->brand == 1);
            $category = (auth()->guard('admin')->user()->category == 1);
            $product = (auth()->guard('admin')->user()->product == 1);
            $slider = (auth()->guard('admin')->user()->slider == 1);
            $coupons = (auth()->guard('admin')->user()->coupons == 1);
            $shipping = (auth()->guard('admin')->user()->shipping == 1);
            $blog = (auth()->guard('admin')->user()->blog == 1);
            $setting = (auth()->guard('admin')->user()->setting == 1);
            $returnorder = (auth()->guard('admin')->user()->returnorder == 1);
            $review = (auth()->guard('admin')->user()->review == 1);
            $orders = (auth()->guard('admin')->user()->orders == 1);
            $stock = (auth()->guard('admin')->user()->stock == 1);
            $reports = (auth()->guard('admin')->user()->reports == 1);
            $alluser = (auth()->guard('admin')->user()->alluser == 1);
            $adminuserrole = (auth()->guard('admin')->user()->adminuserrole == 1);
            @endphp

            @if($brand == true)
            <li class="treeview {{ ($prefix == '/brand') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="message-circle"></i>
                    <span>ブランド (Brands)</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.brand') ? 'active' : '' }}"><a href="{{ route('all.brand') }}"><i class="ti-more"></i>ブランド一覧 (All Brand)</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($category == true)
            <li class="treeview {{ ($prefix == '/category') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="mail"></i> <span>カテゴリー(Categories)</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.category') ? 'active' : '' }}"><a href="{{ route('all.category') }}"><i class="ti-more"></i>カテゴリー一覧</a></li>
                    <li class="{{ ($route == 'all.subCategory') ? 'active' : '' }}"><a href="{{ route('all.subCategory') }}"><i class="ti-more"></i>サブカテゴリー一覧</a></li>
                    <li class="{{ ($route == 'all.subSubCategory') ? 'active' : '' }}"><a href="{{ route('all.subSubCategory') }}"><i class="ti-more"></i>孫カテゴリー一覧</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($product == true)
            <li class="treeview {{ ($prefix == '/product') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="file"></i>
                    <span>商品</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'add-product') ? 'active' : '' }}"><a href="{{ route('add-product') }}"><i class="ti-more"></i>商品登録</a></li>
                    <li class="{{ ($route == 'manage-product') ? 'active' : '' }}"><a href="{{ route('manage-product') }}"><i class="ti-more"></i>商品管理</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($slider == true)
            <li class="treeview {{ ($prefix == '/slider') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="file"></i>
                    <span>スライダー</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage-slider') ? 'active' : '' }}"><a href="{{ route('manage-slider') }}"><i class="ti-more"></i>スライダー管理</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($coupons == true)
            <li class="treeview {{ ($prefix == '/coupons') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="file"></i>
                    <span>クーポン(Coupons)</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage-coupon') ? 'active' : '' }}"><a href="{{ route('manage-coupon') }}"><i class="ti-more"></i>クーポン管理</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($shipping == true)
            <li class="treeview {{ ($prefix == '/shipping') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="file"></i>
                    <span>配送エリア</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage-division') ? 'active' : '' }}"><a href="{{ route('manage-division') }}"><i class="ti-more"></i>都道府県</a></li>
                    <li class="{{ ($route == 'manage-district') ? 'active' : '' }}"><a href="{{ route('manage-district') }}"><i class="ti-more"></i>区・市・町・村</a></li>
                    <li class="{{ ($route == 'manage-town') ? 'active' : '' }}"><a href="{{ route('manage-town') }}"><i class="ti-more"></i>町名</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($blog == true)
            <li class="treeview {{ ($prefix == '/blog') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="file"></i>
                    <span>ブログ管理</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'blog.category') ? 'active' : '' }}"><a href="{{ route('blog.category') }}"><i class="ti-more"></i>ブログカテゴリー</a></li>
                    <li class="{{ ($route == 'list.post') ? 'active' : '' }}"><a href="{{ route('list.post') }}"><i class="ti-more"></i>ブログ一覧</a></li>
                    <li class="{{ ($route == 'add.post') ? 'active' : '' }}"><a href="{{ route('add.post') }}"><i class="ti-more"></i>ブログ作成</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($setting == true)
            <li class="treeview {{ ($prefix == '/setting') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="file"></i>
                    <span>セッティング</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'site.setting') ? 'active' : '' }}"><a href="{{ route('site.setting') }}"><i class="ti-more"></i>サイトセッティング</a></li>
                    <li class="{{ ($route == 'seo.setting') ? 'active' : '' }}"><a href="{{ route('seo.setting') }}"><i class="ti-more"></i>SEOセッティング</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($returnorder == true)
            <li class="treeview {{ ($prefix == '/return') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="file"></i>
                    <span>返品依頼商品</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'return.request') ? 'active' : '' }}"><a href="{{ route('return.request') }}"><i class="ti-more"></i>返品未対応リスト</a></li>
                    <li class="{{ ($route == 'all.request') ? 'active' : '' }}"><a href="{{ route('all.request') }}"><i class="ti-more"></i>返品対応完了リスト</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($review == true)
            <li class="treeview {{ ($prefix == '/review') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="file"></i>
                    <span>商品レビュー管理</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'pending.review') ? 'active' : '' }}"><a href="{{ route('pending.review') }}"><i class="ti-more"></i>保留中商品レビュー</a></li>
                    <li class="{{ ($route == 'publish.review') ? 'active' : '' }}"><a href="{{ route('publish.review') }}"><i class="ti-more"></i>公開中商品レビュー</a></li>
                </ul>
            </li>
            @else
            @endif

            <li class="header nav-small-cap">User Interface</li>

            @if($orders == true)
            <li class="treeview {{ ($prefix == '/orders') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="file"></i>
                    <span>オーダー</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'pending-orders') ? 'active' : '' }}"><a href="{{ route('pending-orders') }}"><i class="ti-more"></i>保留中オーダーリスト</a></li>
                    <li class="{{ ($route == 'confirmed-orders') ? 'active' : '' }}"><a href="{{ route('confirmed-orders') }}"><i class="ti-more"></i>オーダー確認済リスト</a></li>
                    <li class="{{ ($route == 'processing-orders') ? 'active' : '' }}"><a href="{{ route('processing-orders') }}"><i class="ti-more"></i>オーダー対応中リスト</a></li>
                    <li class="{{ ($route == 'picked-orders') ? 'active' : '' }}"><a href="{{ route('picked-orders') }}"><i class="ti-more"></i>発送可能リスト</a></li>
                    <li class="{{ ($route == 'shipped-orders') ? 'active' : '' }}"><a href="{{ route('shipped-orders') }}"><i class="ti-more"></i>発送済リスト</a></li>
                    <li class="{{ ($route == 'delivered-orders')? 'active':'' }}"><a href="{{ route('delivered-orders') }}"><i class="ti-more"></i>配達完了リスト</a></li>
                    <li class="{{ ($route == 'cancel-orders') ? 'active' : '' }}"><a href="{{ route('cancel-orders') }}"><i class="ti-more"></i>キャンセルオーダーリスト</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($stock == true)
            <li class="treeview {{ ($prefix == '/stock') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="file"></i>
                    <span>商品在庫管理</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'product.stock') ? 'active' : '' }}"><a href="{{ route('product.stock') }}"><i class="ti-more"></i>商品在庫リスト</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($reports == true)
            <li class="treeview {{ ($prefix == '/reports') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="file"></i>
                    <span>レポート</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all-reports') ? 'active' : '' }}"><a href="{{ route('all-reports') }}"><i class="ti-more"></i>レポート一覧</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($alluser == true)
            <li class="treeview {{ ($prefix == '/alluser') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="file"></i>
                    <span>会員リスト</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all-users') ? 'active' : '' }}"><a href="{{ route('all-users') }}"><i class="ti-more"></i>会員リスト</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($adminuserrole == true)
            <li class="treeview {{ ($prefix == '/adminuserrole') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="file"></i>
                    <span>管理者</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.admin.user') ? 'active' : '' }}"><a href="{{ route('all.admin.user') }}"><i class="ti-more"></i>管理者リスト</a></li>
                </ul>
            </li>
            @else
            @endif
        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
