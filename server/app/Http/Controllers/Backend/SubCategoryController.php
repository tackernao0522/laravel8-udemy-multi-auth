<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function subCategoryView()
    {
        $subCategories = SubCategory::latest()->get();

        return view('backend.category.subCategory_view', compact('subCategories'));
    }
}
