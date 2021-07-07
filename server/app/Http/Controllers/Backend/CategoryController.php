<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categoryView()
    {
        $categories = Category::latest()->get();

        return view('backend.category.category_view', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        $validatedData = $request->validate([
            'category_name_ja' => 'required|unique:categories',
            'category_name_en' => 'required|unique:categories',
            'category_icon' => 'required|unique:categories',
        ], [
            'category_name_en.required' => 'Input Category English Name',
            'category_name_en.unique' => 'The category name ja has already been taken.',
            'category_icon.unique' => 'このアイコンはすでに使われています。(The icon has already been taken.)',
            'category_icon.required' => 'カテゴリーアイコンは必須です。(Input Category Icon.)',
        ]);

        Category::insert([
            'category_name_ja' => $request->category_name_ja,
            'category_name_en' => $request->category_name_en,
            'category_slug_ja' => str_replace(' ', '-', $request->category_name_ja),
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_icon' => $request->category_icon,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'カテゴリーを作成しました。(Category Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }
}
