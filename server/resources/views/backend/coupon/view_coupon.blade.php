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
                        <h3 class="box-title">クーポンリスト <span class="badge badge-pill badge-danger">{{ count($coupons) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>クーポン名</th>
                                        <th>クーポン割引率(%)</th>
                                        <th>有効期限</th>
                                        <th>ステータス</th>
                                        <th>編集／削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coupons as $item)
                                    <tr>
                                        <td>{{ $item->coupon_name }}</td>
                                        <td>{{ $item->coupon_discount }}%</td>
                                        <td>
                                            {{ Carbon\Carbon::parse($item->coupon_validity)->format('Y年m月d日') }}
                                        </td>
                                        <td>
                                            @if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge badge-pill badge-success">適用期間中</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">期限切れ</span>
                                            @endif
                                        </td>
                                        <td width="30%">
                                            <a href="{{ route('coupon.edit', $item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('coupon.delete', $item->id) }}" onclick="return confirm('削除してよろしいですか？')" class="btn btn-danger" title="Delete Data"><i class="fa fa-trash"></i></a>
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
                        <h3 class="box-title">クーポン作成</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('coupon.store') }}">
                                @csrf
                                <div class="form-group">
                                    <h5>クーポン名 <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="coupon_name" class="form-control" value="{{ old('coupon_name') }}">
                                        @error('coupon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>クーポン割引率(%)<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="coupon_discount" class="form-control" value="{{ old('coupon_discount') }}">
                                        @error('coupon_discount')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>クーポン有効期限日<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="coupon_validity" class="form-control" value="{{ old('coupon_validity') }}" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                        @error('coupon_validity')
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
