<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Admin;

class AdminUserController extends Controller
{
    public function allAdminRole()
    {
        $adminUsers = Admin::where('type', 2)->latest()->get();

        return view('backend.role.admin_role_all', compact('adminUsers'));
    }
}
