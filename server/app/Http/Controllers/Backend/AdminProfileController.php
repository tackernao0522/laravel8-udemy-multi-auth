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
use App\Models\User;

class AdminProfileController extends Controller
{
    public function adminProfile()
    {
        $id = Auth::user()->id;
        $adminData = Admin::find($id);

        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function adminProfileEdit()
    {
        $id = Auth::user()->id;
        $editData = Admin::find($id);

        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function adminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = Admin::find($id);
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

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = Admin::find(Auth::id());
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();

            return redirect()->route('admin.logout');
        } else {
            return redirect()->back()
                ->with('error', '現在のパスワードが一致しません。');
        }
    }

    public function allUsers()
    {
        $users = User::latest()->get();

        return view('backend.user.all_user', compact('users'));
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
