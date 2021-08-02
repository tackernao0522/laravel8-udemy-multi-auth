<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\SiteSetting;

class SiteSettingController extends Controller
{
    public function siteSetting()
    {
        $setting = SiteSetting::find(1);

        return view('backend.setting.setting_update', compact('setting'));
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->resize(917, 1000)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('products/thambnail', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
