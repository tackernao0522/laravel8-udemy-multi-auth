<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminUserController extends Controller
{
    public function allAdminRole()
    {
        $adminUsers = Admin::where('type', 2)->latest()->get();

        return view('backend.role.admin_role_all', compact('adminUsers'));
    }

    public function addAdminRole()
    {
        return view('backend.role.admin_role_create');
    }

    public function storeAdminRole(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins',
            'phone' => 'nullable|string|unique:admins',
            'password' => 'required',
            'profile_photo_path' => 'nullable|mimes:jpg,jpeg,png',
        ], [
            'name.required' => '名前は必須です。(Input Name English Name.)',
            'email.required' => 'メールアドレスは必須です。(Input Email.)',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'パスワードを設定してください。(Input Password.)',
            'profile_photo_path.mimes' => '画像にはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。(The Admin User image must be a file of type: jpg, jpeg, png.)',
        ]);

        $fileName = $this->saveImage($request->file('profile_photo_path'));

        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'brand' => $request->brand,
            'category' => $request->category,
            'product' => $request->product,
            'slider' => $request->slider,
            'coupons' => $request->coupons,
            'shipping' => $request->shipping,
            'blog' => $request->blog,
            'setting' => $request->setting,
            'returnorder' => $request->returnorder,
            'review' => $request->review,
            'orders' => $request->orders,
            'stock' => $request->stock,
            'reports' => $request->reports,
            'alluser' => $request->alluser,
            'adminuserrole' => $request->adminuserrole,
            'type' => 2,
            'profile_photo_path' => $fileName,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '管理者を追加しました。(Admin User Created Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->route('all.admin.user')
            ->with($notification);
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(225, 225)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('admin-profile', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
