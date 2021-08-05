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
                        <h3 class="box-title">管理者リスト</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>画像</th>
                                        <th>名前</th>
                                        <th>メールアドレス</th>
                                        <th>アクセス</th>
                                        <th>詳細／削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($adminUsers as $item)
                                    <tr>
                                        <td><img src="{ (!empty($item->profile_photo_path)) ? Storage::disk('s3')->url(" admin-profile/{$item->profile_photo_path}") : url('backend/images/avatar/1.jpg') }}" alt=""></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td></td>
                                        <td width="20%">
                                            <a href="{{ route('pending.order.details', $item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-eye"></i></a>
                                            <a target="_blank" href="{{ route('invoice.download', $item->id) }}" class="btn btn-danger" title="Invoice Download"><i class="fa fa-download"></i></a>
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
