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

            <li class="header nav-small-cap">User Interface</li>

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

            <li class="treeview">
                <a href="#">
                    <i data-feather="credit-card"></i>
                    <span>Cards</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="card_advanced.html"><i class="ti-more"></i>Advanced Cards</a></li>
                    <li><a href="card_basic.html"><i class="ti-more"></i>Basic Cards</a></li>
                    <li><a href="card_color.html"><i class="ti-more"></i>Cards Color</a></li>
                </ul>
            </li>
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
