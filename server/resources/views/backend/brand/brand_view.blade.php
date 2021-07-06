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
                        <h3 class="box-title">ブランドリスト</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ブランド名 (日本語)</th>
                                        <th>Brand (English)</th>
                                        <th>画像</th>
                                        <th>編集／削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($brands as $item)
                                    <tr>
                                        <td>{{ $item->brand_name_ja }}</td>
                                        <td>{{ $item->brand_name_en }}</td>
                                        <td><img src="{{ Storage::disk('s3')->url("brands/{$item->brand_image}") }}" style="height:40px; width:70px"></td>
                                        <td>
                                            <a href="{{ url('brand/edit/'.$item->id) }}" class="btn btn-info">編集</a>
                                            <a href="{{ url('brand/delete/'.$item->id) }}" onclick="return confirm('削除してよろしいですか？')" class="btn btn-danger">削除</a>
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