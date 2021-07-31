@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">ブランドリスト <span class="badge badge-pill badge-danger">{{ count($brands) }}</h3>
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
                                            <a href="{{ route('brand.edit', $item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('brand.delete', $item->id) }}" onclick="return confirm('削除してよろしいですか？')" class="btn btn-danger" title="Delete Data"><i class="fa fa-trash"></i></a>
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

            <!-- Add Brand Page -->
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">ブランド作成</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>ブランド名 <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="brand_name_ja" class="form-control" value="{{ old('brand_name_ja') }}">
                                        @error('brand_name_ja')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Brand Name (English) <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="brand_name_en" class="form-control" value="{{ old('brand_name_en') }}">
                                        @error('brand_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>ブランド画像(Image) <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="brand_image" class="form-control">
                                        @error('brand_image')
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
