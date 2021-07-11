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
                        <h3 class="box-title">スライダーリスト</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>スライダー画像</th>
                                        <th>タイトル</th>
                                        <th>コンテンツ</th>
                                        <th>状態</th>
                                        <th>編集／削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sliders as $item)
                                    <tr>
                                        <td><img src="{{ Storage::disk('s3')->url("sliders/{$item->slider_img}") }}" style="height:40px; width:70px"></td>
                                        <td>
                                            @if($item->title == NULL)
                                            <span class="badge badge-pill badge-danger">No Title</span>
                                            @else
                                            {{ $item->title }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->description == NULL)
                                            <span class="badge badge-pill badge-danger">No Description</span>
                                            @else
                                            {{ $item->description }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status == 1)
                                            <span class="badge badge-pill badge-success">アクティブ</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">非アクティブ</span>
                                            @endif
                                        </td>
                                        <td width="30%">
                                            <a href="{{ route('slider.edit', $item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('slider.delete', $item->id) }}" onclick="return confirm('削除してよろしいですか？')" class="btn btn-danger" title="Delete Data"><i class="fa fa-trash"></i></a>
                                            @if($item->status == 1)
                                            <a href="{{ route('slider.inactive', $item->id) }}" class="btn btn-danger" title="非アクティブ"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a href="{{ route('slider.active', $item->id) }}" class="btn btn-success" title="アクティブ"><i class="fa fa-arrow-up"></i></a>
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

            <!-- Add Slider Page -->
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">スライダー作成</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>スライダータイトル (Slider Title) <span class="text-danger">任意</span></h5>
                                    <div class="controls">
                                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>コンテンツ (Slider Description) <span class="text-danger">任意</span></h5>
                                    <div class="controls">
                                        <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>スライダー画像 (Slider Image) <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="slider_img" class="form-control">
                                        @error('slider_img')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right mt-3">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="作成">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
