<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Blog\BlogPostCategory;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function blogCategory()
    {
        $blogCategories = BlogPostCategory::latest()->get();

        return view('backend.blog.category.category_view', compact('blogCategories'));
    }

    public function blogCategoryStore(Request $request)
    {
        $validatedData = $request->validate([
            'blog_category_name_ja' => 'required|unique:blog_post_categories',
            'blog_category_name_en' => 'required|unique:blog_post_categories',
        ], [
            'blog_category_name_en.required' => 'Input Blog Category English Name',
            'blog_category_name_en.unique' => 'The Blog Category name(English) has already been taken.',
        ]);

        BlogPostCategory::insert([
            'blog_category_name_ja' => $request->blog_category_name_ja,
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_slug_ja' => str_replace(' ', '-', $request->blog_category_name_ja),
            'blog_category_slug_en' => strtolower(str_replace(' ', '-', $request->blog_category_name_en)),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ブログカテゴリーを作成しました。(Blog Category Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function blogCategoryEdit($id)
    {
        $blogCategory = BlogPostCategory::findOrFail($id);

        return view('backend.blog.category.category_edit', compact('blogCategory'));
    }

    public function blogCategoryUpdate(Request $request, $id)
    {
        $blogCategory = BlogPostCategory::findOrFail($id);
        $validatedData = $request->validate([
            'blog_category_name_ja' => 'required',
            'blog_category_name_en' => 'required',
        ], [
            'blog_category_name_en.required' => 'Input Blog Category English Name.',
        ]);

        $blogCategory->blog_category_name_ja = $request->blog_category_name_ja;
        $blogCategory->blog_category_name_en = $request->blog_category_name_en;
        $blogCategory->blog_category_slug_ja = str_replace(' ', '-', $request->blog_category_name_ja);
        $blogCategory->blog_category_slug_en = strtolower(str_replace(' ', '-', $request->blog_category_name_en));
        $blogCategory->updated_at = Carbon::now();
        $blogCategory->save();

        $notification = array(
            'message' => 'ブログカテゴリーID：' . $blogCategory->id . 'を更新しました(Blog Category Updated Successfully)。',
            'alert-type' => 'info',
        );

        return redirect()->route('blog.category')
            ->with($notification);
    }

    public function viewBlogPost()
    {
        $blogCategories = BlogPostCategory::latest()->get();
        $blogPosts =  BlogPost::latest()->get();

        return view('backend.blog.post.post_view', compact('blogPosts', 'blogCategories'));
    }
}
