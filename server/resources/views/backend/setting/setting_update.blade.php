@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">サイトセッティング</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="POST" action="{{ route('update.siteSetting', $setting->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>サイトロゴ <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="file" name="logo" class="form-control">
                                                    @error('logo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>電話番号1 <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="phone_one" class="form-control" value="{{ old('phone_one', $setting->phone_one) }}">
                                                    @error('phone_one')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>電話番号2 <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="phone_two" class="form-control" value="{{ old('phone_two', $setting->phone_two) }}">
                                                    @error('phone_two')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>メールアドレス <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control" value="{{ old('email', $setting->email) }}">
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>会社名 <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $setting->company_name) }}">
                                                    @error('company_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>所在地 <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="company_address" class="form-control" value="{{ old('company_address', $setting->company_address) }}">
                                                    @error('company_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Facebook <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $setting->facebook) }}">
                                                    @error('facebook')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Twitter<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="twitter" class="form-control" value="{{ old('twitter', $setting->twitter) }}">
                                                    @error('twitter')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Linkedin <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="linkedin" class="form-control" value="{{ old('linkedin', $setting->linkedin) }}">
                                                    @error('linkedin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Youtube <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="youtube" class="form-control" value="{{ old('youtube', $setting->youtube) }}">
                                                    @error('youtube')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end cold md 6 -->
                                    </div> <!-- end row -->

                                    <div class="text-xs-right mt-3">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="更新">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
@endsection
