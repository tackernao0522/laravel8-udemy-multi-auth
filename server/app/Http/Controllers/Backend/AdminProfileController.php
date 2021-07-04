<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminProfileController extends Controller
{
    public function adminProfile()
    {
        $adminData = Admin::find(1);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function adminProfileEdit()
    {
        $editData = Admin::find(1);

        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function adminProfileStore(Request $request)
    {
        $data = Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->has('profile_photo_path')) {
            Storage::disk('s3')->delete('/admin-profile/' . $data->profile_photo_path);
            $data->delete();
            $fileName = $this->saveImage($request->file('profile_photo_path'));
            $data['profile_photo_path'] = $fileName;
        }

        $data->save();

        $nofification = array(
            'message' => '管理者プロフィールを更新しました。',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($nofification);
    }

    public function adminChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function AdminUpdateChangePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Admin::find(1)->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();

            return redirect()->route('admin.logout');
        } else {
            return redirect()->back()
                ->with('error', '現在のパスワードが一致しません。');
        }
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->resize(100, 100)->save($tempPath);

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
