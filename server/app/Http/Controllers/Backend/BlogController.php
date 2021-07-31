<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPostCategory;

class BlogController extends Controller
{
    public function blogCategory()
    {
        $blogCategories = BlogPostCategory::latest()->get();

        return view('backend.blog.category.category_view', compact('blogCategories'));
    }
}
