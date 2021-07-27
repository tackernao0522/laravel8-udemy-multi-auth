@php
$id = Auth::user()->id;
$user = App\Models\User::find($id);
@endphp
<div class="col-md-2"><br>
    <img class="card-img-top" style="border-radius: 50%" src="{{ (!empty($user->profile_photo_path)) ? Storage::disk('s3')->url("user-profile/{$user->profile_photo_path}") : url('upload/no_image.jpg') }}" alt="プロフィール画像" height="100%" width="100%"><br><br>
    <ul class="list-group list-group-flush">
        <a href="" class="btn btn-primary btn-sm btn-block">Home</a>
        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">プロフィール更新</a>
        <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">パスワード変更</a>
        <a href="{{ route('my.orders') }}" class="btn btn-primary btn-sm btn-block">オーダー</a>
        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">ログアウト</a>
    </ul>
</div> <!-- end col-md-2 -->
