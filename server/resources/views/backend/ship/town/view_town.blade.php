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
                        <h3 class="box-title">町名リスト</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>都道府県</th>
                                        <th>区・市・町・村</th>
                                        <th>町名</th>
                                        <th>編集／削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($towns as $item)
                                    <tr>
                                        <td>{{ $item->division_id }}</td>
                                        <td>{{ $item->district_id }}</td>
                                        <td>{{ $item->town_name }}</td>
                                        <td width="40%">
                                            <a href="{{ route('district.edit', $item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('district.delete', $item->id) }}" onclick="return confirm('削除してよろしいですか？')" class="btn btn-danger" title="Delete Data"><i class="fa fa-trash"></i></a>
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

            <!-- Add Categoy Page -->
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">町名 登録</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('district.store') }}">
                                @csrf
                                <div class="form-group">
                                    <h5>都道府県 <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="division_id" class="form-control">
                                            <option value="" selected="" disabled="">都道府県 選択</option>
                                            @foreach($divisions as $division)
                                            <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected': '' }}>{{ $division->division_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('division_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>区・市・町・村 <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="district_id" class="form-control">
                                            <option value="" selected="" disabled="">区・市・町・村 選択</option>
                                            @foreach($districts as $district)
                                            <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected': '' }}>{{ $district->district_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('district_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>町名<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="town_name" class="form-control" value="{{ old('town_name') }}">
                                        @error('town_name')
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
