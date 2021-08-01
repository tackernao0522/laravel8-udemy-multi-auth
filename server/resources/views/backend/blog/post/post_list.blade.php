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
                        <h3 class="box-title">ブログ投稿リスト <span class="badge badge-pill badge-danger">{{ count($blogPosts) }}</span></h3>
                        <div>
                            <a href="{{ route('add.post') }}" class="btn btn-success">ブログ作成</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ブログカテゴリー名</th>
                                        <th>ブログ画像</th>
                                        <th>ブログタイトル</th>
                                        <th>Post Title En</th>
                                        <th>編集／削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogPosts as $item)
                                    <tr>
                                        <td>{{ $item->category_id }}</td>
                                        <td><img src="{{ Storage::disk('s3')->url("blogs/{$item->post_image}") }}" alt="" style="width: 60px; height: 60px"></td>
                                        <td>{!! nl2br(e(Str::limit($item->post_title_ja, 45))) !!}</td>
                                        <td>{!! nl2br(e(Str::limit($item->post_title_en, 45))) !!}</td>
                                        <td width="30%">
                                            <a href="{{ route('blog.category.edit', $item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('category.delete', $item->id) }}" class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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
