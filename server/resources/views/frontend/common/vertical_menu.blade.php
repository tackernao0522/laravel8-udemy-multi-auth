@php
$categories = App\Models\Category::orderBy('category_name_ja', 'ASC')->get();
@endphp
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i>@if(session()->get('language') == 'english') Categories @else カテゴリー @endif</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            @foreach($categories as $category)
            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $category->category_icon }}" aria-hidden="true"></i>@if(session()->get('language') == 'english') {{ $category->category_name_en }} @else {{ $category->category_name_ja }} @endif</a>
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                            @php
                            $subCategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subCategory_name_ja','ASC')->get();
                            @endphp
                            @foreach($subCategories as $subCategory)
                            <div class="col-sm-12 col-md-3">
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
                                <ul class="links list-unstyled">
                                    @if(session()->get('language') == 'english')
                                    <li><a href="{{ url('subSubCategory/product/' . $subSubCategory->id . '/' . $subSubCategory->subSubCategory_slug_en) }}">{{ $subSubCategory->subSubCategory_name_en }}</a></li>
                                    @else
                                    <li><a href="{{ url('subSubCategory/product/' . $subSubCategory->id . '/' . $subSubCategory->subSubCategory_slug_ja) }}">{{ $subSubCategory->subSubCategory_name_ja }}</a></li>
                                    @endif
                                </ul>
                                @endforeach
                                <!-- end SubSubCategory Foreach -->
                            </div>
                            @endforeach
                            <!-- end SubCategory Foreach -->
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                </ul>
                <!-- /.dropdown-menu -->
            </li>
            <!-- /.menu-item -->
            @endforeach
            <!-- end Category Foreach -->

            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-paper-plane"></i>Kids and Babies</a>
                <!-- /.dropdown-menu -->
            </li>
            <!-- /.menu-item -->

            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-futbol-o"></i>Sports</a>
                <!-- ================================== MEGAMENU VERTICAL ================================== -->
                <!-- /.dropdown-menu -->
                <!-- ================================== MEGAMENU VERTICAL ================================== -->
            </li>
            <!-- /.menu-item -->

            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-envira"></i>Home and Garden</a>
                <!-- /.dropdown-menu -->
            </li>
            <!-- /.menu-item -->

        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
<!-- /.side-menu -->
