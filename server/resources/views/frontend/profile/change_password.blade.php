@extends('frontend.main_master')

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">

            @include('frontend.common.user_sidebar')

            <div class="col-md-2">
            </div> <!-- end col-md-2 -->

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">パスワードの変更 </span><strong></strong></h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.password.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">現在のパスワード <span class="text-danger">* </span></label>
                                <input type="password" id="current_password" name="oldpassword" class="form-control">
                                @error('oldpassword')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">新しいパスワード <span class="text-danger">* </span></label>
                                <input type="password" id="password" name="password" class="form-control">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">新しいパスワード(確認) <span class="text-danger">* </span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">更新</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col-md-6 -->
        </div> <!-- end row -->
    </div>
</div>
@endsection
