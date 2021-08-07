<ul>
    @foreach($products as $item)
    <li><img src="{{ Storage::disk('s3')->url("products/thambnail/{$item->product_thambnail}") }}" alt="商品画像" style="width: 30px; height: 30px"> {{ $item->product_name_ja }} </li>
    @endforeach
</ul>
