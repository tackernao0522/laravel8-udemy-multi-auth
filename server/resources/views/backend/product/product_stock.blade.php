@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">商品在庫リスト <span class="badge badge-pill badge-danger">{{ count($products) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>メイン画像</th>
                                        <th>商品名</th>
                                        <th>価格</th>
                                        <th>在庫数</th>
                                        <th>割引率</th>
                                        <th>状態</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $item)
                                    <tr>
                                        <td width="15%"><img src="{{ Storage::disk('s3')->url("products/thambnail/{$item->product_thambnail}") }}" style="height:50px; width:60px"></td>
                                        <td>{{ $item->product_name_ja }}</td>
                                        <td width="11%">
                                            ¥ {{ $item->selling_price  }}
                                        </td>
                                        <td width="11%">{{ $item->product_qty }} Pic</td>
                                        <td width="11%">
                                            @if($item->discount_price == NULL)
                                            <span class="badge badge-pill badge-danger">割引なし</span>
                                            @else
                                            @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = ($amount/$item->selling_price) * 100;
                                            @endphp
                                            <span class="badge badge-pill badge-danger">{{ round($discount) }} %</span>
                                            @endif
                                        </td>
                                        <td width="14%">
                                            @if($item->status == 1)
                                            <span class="badge badge-pill badge-success">販売中</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">停止中</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
