@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Add Slider Page -->
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">スライダー更新</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('slider.update', $slider->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>スライダータイトル (Slider Title) <span class="text-danger">任意</span></h5>
                                    <div class="controls">
                                        <input type="text" name="title" class="form-control" value="{{ old('title', $slider->title) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>コンテンツ (Slider Description) <span class="text-danger">任意</span></h5>
                                    <div class="controls">
                                        <input type="text" name="description" class="form-control" value="{{ old('description', $slider->description) }}">
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
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="更新">
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
