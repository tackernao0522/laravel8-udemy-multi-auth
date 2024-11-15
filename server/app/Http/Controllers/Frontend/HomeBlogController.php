<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPostCategory;
use App\Models\BlogPost;

class HomeBlogController extends Controller
{
    public function AddBlogPost()
    {
        $blogCategories = BlogPostCategory::latest()->get();
        $blogPosts = BlogPost::latest()->get();

        return view('frontend.blog.blog_list', compact('blogCategories', 'blogPosts'));
    }

    public function detailsBlogPost($id)
    {
        $blogCategories = BlogPostCategory::latest()->get();
        $blogPost = BlogPost::findOrFail($id);

        return view('frontend.blog.blog_details', compact('blogPost', 'blogCategories'));
    }

    public function homeBlogCatPost($category_id)
    {
        $blogCategories = BlogPostCategory::latest()->get();
        $blogPosts = BlogPost::where('category_id', $category_id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('frontend.blog.blog_cat_list', compact('blogCategories', 'blogPosts'));
    }
}
