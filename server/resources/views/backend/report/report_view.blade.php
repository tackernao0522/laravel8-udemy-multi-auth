@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Add Search Page -->
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">年月日別検索</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('search-by-date') }}">
                                @csrf
                                <div class="form-group">
                                    <h5>年月日選択 <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" class="form-control" value="{{ old('brand_name_ja') }}">
                                        @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right mt-3">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="検索">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">年月別検索</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('search-by-month') }}">
                                @csrf
                                <div class="form-group">
                                    <h5>年選択 <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="year_name" class="form-control">
                                            <option label="年選択"></option>
                                            <option value="2021年">2021年</option>
                                            <option value="2022年">2022年</option>
                                            <option value="2023年">2023年</option>
                                            <option value="2024年">2024年</option>
                                            <option value="2025年">2025年</option>
                                            <option value="2026年">2026年</option>
                                            <option value="2027年">2027年</option>
                                            <option value="2028年">2028年</option>
                                            <option value="2029年">2029年</option>
                                            <option value="2030年">2030年</option>
                                            <option value="2031年">2031年</option>
                                            <option value="2032年">2032年</option>
                                        </select>
                                        @error('year_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>月選択 <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="month" class="form-control">
                                            <option label="月選択"></option>
                                            <option value="1月">1月</option>
                                            <option value="2月">2月</option>
                                            <option value="3月">3月</option>
                                            <option value="4月">4月</option>
                                            <option value="5月">5月</option>
                                            <option value="6月">6月</option>
                                            <option value="7月">7月</option>
                                            <option value="8月">8月</option>
                                            <option value="9月">9月</option>
                                            <option value="10月">10月</option>
                                            <option value="11月">11月</option>
                                            <option value="12月">12月</option>
                                        </select>
                                        @error('month')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right mt-3">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="検索">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">年別検索</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('search-by-year') }}">
                                @csrf
                                <div class="form-group">
                                    <h5>年別検索 <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="year" class="form-control">
                                            <option label="年選択"></option>
                                            <option value="2021年">2021年</option>
                                            <option value="2022年">2022年</option>
                                            <option value="2023年">2023年</option>
                                            <option value="2024年">2024年</option>
                                            <option value="2025年">2025年</option>
                                            <option value="2026年">2026年</option>
                                            <option value="2027年">2027年</option>
                                            <option value="2028年">2028年</option>
                                            <option value="2029年">2029年</option>
                                            <option value="2030年">2030年</option>
                                            <option value="2031年">2031年</option>
                                            <option value="2032年">2032年</option>
                                        </select>
                                        @error('year')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right mt-3">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="検索">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- End Add Search Page -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
