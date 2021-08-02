<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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

    public function listBlogPost()
    {
        $blogPosts = BlogPost::with('category')->latest()->get();

        return view('backend.blog.post.post_list', compact('blogPosts'));
    }

    public function addBlogPost()
    {
        $blogCategories = BlogPostCategory::latest()->get();
        $blogPosts =  BlogPost::latest()->get();

        return view('backend.blog.post.post_add', compact('blogPosts', 'blogCategories'));
    }

    public function blogPostStore(Request $request)
    {
        $validatedData = $request->validate([
            'post_title_ja' => 'required|unique:blog_posts',
            'post_title_en' => 'required|unique:blog_posts',
            'category_id' => 'required',
            'post_image' => 'required|mimes:jpg,jpeg,png',
            // 'post_details_ja' => 'required|unique:blog_posts',
            // 'post_details_en' => 'required|unique:blog_posts',
        ], [
            'post_title_en.required' => 'Input Blog Title English.',
            'post_title_en.unique' => 'The Blog Title En has already been taken.',
            'category_id.required' => 'カテゴリーを選択してください。(Input Blog Category)',
            'post_image.required' => 'ブログ画像は必須です。(Input Blog Image.)',
            'post_image.mimes' => 'ブログ画像にはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。(The Blog Image must be a file of type: jpg, jpeg, png.)',
            // 'post_details_en.required' => 'Input Blog English.',
            // 'post_details_en.unique' => 'The Blog English English has already been taken.',
        ]);

        $fileName = $this->saveImage($request->file('post_image'));

        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title_ja' => $request->post_title_ja,
            'post_title_en' => $request->post_title_en,
            'post_slug_ja' => str_replace(' ', '-', $request->post_title_ja),
            'post_slug_en' => strtolower(str_replace(' ', '-', $request->post_title_en)),
            'post_image' => $fileName,
            'post_details_ja' => $request->post_details_ja,
            'post_details_en' => $request->post_details_en,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ブログを作成しました。(Blog Post Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->route('list.post')
            ->with($notification);
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(780, 433)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('blogs', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
