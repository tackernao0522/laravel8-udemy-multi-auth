@php
$tags_ja = App\Models\Product::groupBy('product_tags_ja')->select('product_tags_ja')->get();
$tags_en = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
@endphp

<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">@if(session()->get('language') == 'english') Product tags @else 商品タグ @endif</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @if(session()->get('language') == 'english')
            @foreach($tags_en as $tag)
            <a class="item active" title="Phone" href="{{ url('product/tag/'.$tag->product_tags_en) }}">{{ $tag->product_tags_en }}</a>
            @endforeach
            @endif
            @if(session()->get('language') == 'japanese')
            @foreach($tags_ja as $tag)
            <a class="item active" title="Phone" href="{{ url('product/tag/'.$tag->product_tags_ja) }}">{{ $tag->product_tags_ja }}</a>
            @endforeach
            @endif
        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
<!-- /.sidebar-widget -->
