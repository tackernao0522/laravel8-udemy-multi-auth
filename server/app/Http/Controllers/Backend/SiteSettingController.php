<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\SiteSetting;
use App\Models\Seo;

class SiteSettingController extends Controller
{
    public function siteSetting()
    {
        $setting = SiteSetting::find(1);

        return view('backend.setting.setting_update', compact('setting'));
    }

    public function siteSettingUpdate(Request $request)
    {
        $setting = SiteSetting::findOrFail(1);
        $validatedData = $request->validate([
            'logo' => 'nullable',
            'phone_one' => 'nullable',
            'phone_two' => 'nullable',
            'email' => 'nullable|email',
            'company_name' => 'nullable',
            'company_address' => 'nullable',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',
            'logo' => 'mimes:jpg,jpeg,png',
        ], [
            'logo.mimes' => 'サイトロゴにはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。(The Site Logo image must be a file of type: jpg, jpeg, png.)',
        ]);

        if ($request->has('logo')) {
            Storage::disk('s3')->delete('/siteLogo/' . $setting->logo);
            $setting->delete();
            $fileName = $this->saveImage($request->file('logo'));
            $setting->logo = $fileName;
        }

        $setting->phone_one = $request->phone_one;
        $setting->phone_two = $request->phone_two;
        $setting->email = $request->email;
        $setting->company_name = $request->company_name;
        $setting->company_address = $request->company_address;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->linkedin = $request->linkedin;
        $setting->youtube = $request->youtube;
        $setting->save();

        $notification = array(
            'message' => 'セッティングID：' . $setting->id . 'を更新しました(Site Setting Updated Successfully)。',
            'alert-type' => 'info',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function seoSetting()
    {
        $seo = Seo::find(1);

        return view('backend.setting.seo_update', compact('seo'));
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(139, 36)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('siteLogo', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
