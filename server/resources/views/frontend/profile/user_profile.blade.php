@extends('frontend.main_master')

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><br>
                <img class="card-img-top" style="border-radius: 50%" src="{{ (!empty($user->profile_photo_path)) ? Storage::disk('s3')->url("user-profile/{$user->profile_photo_path}") : url('upload/no_image.jpg') }}" alt="プロフィール画像" height="100%" width="100%"><br><br>
                <ul class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">プロフィール更新</a>
                    <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">パスワード変更</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">ログアウト</a>
                </ul>
            </div> <!-- end col-md-2 -->

            <div class="col-md-2">

            </div> <!-- end col-md-2 -->

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi.... </span><strong>{{ Auth::user()->name }}</strong> Update Your Profile</h3>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">ユーザー名 <span> </span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">メールアドレス <span> </span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">電話番号 <span> </span></label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">プロフィール画像 <span> </span></label>
                                <input type="file" name="profile_photo_path" class="form-control">
                                @error('profile_photo_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
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