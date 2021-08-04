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
                        <h3 class="box-title">公開中商品レビューリスト <span class="badge badge-pill badge-danger">{{ count($reviews) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>概要</th>
                                        <th>レビュー</th>
                                        <th>ユーザー</th>
                                        <th>商品名</th>
                                        <th>ステータス</th>
                                        <th>削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $item)
                                    <tr>
                                        <td>{{ $item->summary }}</td>
                                        <td>{!! nl2br(e($item->comment)) !!}</td>
                                        <td width="14%">{{ $item->user->name }}</td>
                                        <td>{!! nl2br(e($item->product->product_name_ja)) !!}</td>
                                        <td width="18%">
                                            @if($item->status == 0)
                                            <span class="badge badge-pill badge-primary">未対応</span>
                                            @elseif($item->status == 1)
                                            <span class="badge badge-pill badge-success">公開中</span>
                                            @endif
                                        </td>
                                        <td width="15%">
                                            <a href="{{ route('delete.review', $item->id) }}" class="btn btn-danger" id="delete">削除</a>
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
