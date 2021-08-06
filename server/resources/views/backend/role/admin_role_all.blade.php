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
                        <h3 class="box-title">管理者リスト <span class="badge badge-pill badge-danger">{{ count($adminUsers) }}名</span></h3>
                        <div>
                            <a href="{{ route('add.admin') }}" class="btn btn-danger">管理者追加</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped" style="overflow-x: scroll; white-space: nowrap; -webkit-overflow-scrolling: touch">
                                <thead>
                                    <tr>
                                        <th>画像</th>
                                        <th>名前</th>
                                        <th>メールアドレス</th>
                                        <th>アクセス権限</th>
                                        <th>詳細／削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($adminUsers as $item)
                                    <tr>
                                        <td><img src="{{ (!empty($item->profile_photo_path)) ? Storage::disk('s3')->url("admin-profile/{$item->profile_photo_path}") : url('backend/images/avatar/1.jpg') }}" alt="" style="width: 50px; height: 50px"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @if($item->brand == 1)
                                            <span class="badge btn-primary">ブランド</span>
                                            @else
                                            @endif

                                            @if($item->category == 1)
                                            <span class="badge btn-secondary">カテゴリー</span>
                                            @else
                                            @endif

                                            @if($item->product == 1)
                                            <span class="badge btn-success">商品</span>
                                            @else
                                            @endif

                                            @if($item->slider == 1)
                                            <span class="badge btn-danger">スライダー</span>
                                            @else
                                            @endif

                                            @if($item->coupons == 1)
                                            <span class="badge btn-warning">クーポン</span>
                                            @else
                                            @endif

                                            @if($item->shipping == 1)
                                            <span class="badge btn-info">配送エリア</span>
                                            @else
                                            @endif

                                            @if($item->blog == 1)
                                            <span class="badge btn-light">ブログ</span>
                                            @else
                                            @endif

                                            @if($item->setting == 1)
                                            <span class="badge btn-dark">セッティング</span>
                                            @else
                                            @endif
                                            @if($item->returnorder == 1)
                                            <span class="badge btn-primary">返品</span>
                                            @else
                                            @endif

                                            @if($item->review == 1)
                                            <span class="badge btn-secondary">商品レビュー</span>
                                            @else
                                            @endif
                                            @if($item->orders == 1)
                                            <span class="badge btn-success">オーダー</span>
                                            @else
                                            @endif

                                            @if($item->stock == 1)
                                            <span class="badge btn-danger">在庫</span>
                                            @else
                                            @endif

                                            @if($item->reports == 1)
                                            <span class="badge btn-warning">レポート</span>
                                            @else
                                            @endif

                                            @if($item->alluser == 1)
                                            <span class="badge btn-info">会員リスト</span>
                                            @else
                                            @endif

                                            @if($item->adminuserrole == 1)
                                            <span class="badge btn-dark">管理者</span>
                                            @else
                                            @endif
                                        </td>
                                        <td width="20%">
                                            <a href="{{ route('edit.admin.user', $item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('delete.admin.user', $item->id) }}" class="btn btn-danger" title="Delete" id="delete"><i class="fa fa-trash"></i></a>
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
