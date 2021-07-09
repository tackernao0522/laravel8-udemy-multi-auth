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
                        <h3 class="box-title">商品リスト</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>商品画像(サムネイル)</th>
                                        <th>商品名 (日本語)</th>
                                        <th>Product Name (English)</th>
                                        <th>在庫数</th>
                                        <th>編集／削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $item)
                                    <tr>
                                        <td><img src="{{ Storage::disk('s3')->url("products/thambnail/{$item->product_thambnail}") }}" style="height:50px; width:60px"></td>
                                        <td>{{ $item->product_name_ja }}</td>
                                        <td>{{ $item->product_name_en }}</td>
                                        <td>{{ $item->product_qty }}</td>
                                        <td width="30%">
                                            <a href="{{ route('category.edit', $item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('category.delete', $item->id) }}" onclick="return confirm('削除してよろしいですか？')" class="btn btn-danger" title="Delete Data"><i class="fa fa-trash"></i></a>
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
