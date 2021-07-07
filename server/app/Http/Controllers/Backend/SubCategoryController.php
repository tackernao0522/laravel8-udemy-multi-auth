<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function subCategoryView()
    {
        $categories = Category::orderBy('category_name_ja', 'ASC')->get();
        $subCategories = SubCategory::latest()->get();

        return view('backend.category.subCategory_view', compact('subCategories', 'categories'));
    }

    public function subCategoryStore(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subCategory_name_ja' => 'required|unique:sub_categories',
            'subCategory_name_en' => 'required|unique:sub_categories',
        ], [
            'category_id.required' => 'メインカテゴリーを選択してください。(Please select Any option.)',
            'subCategory_name_en.required' => 'Input SubCategory English Name.',
            'subCategory_name_en.unique' => 'The subCategory name ja has already been taken.',
        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subCategory_name_ja' => $request->subCategory_name_ja,
            'subCategory_name_en' => $request->subCategory_name_en,
            'subCategory_slug_ja' => str_replace(' ', '-', $request->subCategory_name_ja),
            'subCategory_slug_en' => strtolower(str_replace(' ', '-', $request->subCategory_name_en)),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'サブカテゴリーを作成しました。(SubCategory Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function subCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_ja', 'ASC')->get();

        $subCategory = SubCategory::findOrFail($id);

        return view('backend.category.subCategory_edit', compact('subCategory', 'categories'));
    }

    public function subCategoryUpdate(Request $request, $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subCategory_name_ja' => 'required',
            'subCategory_name_en' => 'required',
        ], [
            'category_id.required' => 'メインカテゴリーを選択してください。(Please select Any option.)',
            'subCategory_name_en.required' => 'Input SubCategory English Name.',
        ]);

        $subCategory->category_id = $request->category_id;
        $subCategory->subCategory_name_ja = $request->subCategory_name_ja;
        $subCategory->subCategory_name_en = $request->subCategory_name_en;
        $subCategory->subCategory_slug_ja = str_replace(' ', '-', $request->subCategory_name_ja);
        $subCategory->subCategory_slug_en = strtolower(str_replace(' ', '-', $request->subCategory_name_en));
        $subCategory->save();

        $notification = array(
            'message' => 'カテゴリーID：' . $subCategory->id . 'を更新しました(SubCategory Updated Successfully)。',
            'alert-type' => 'info',
        );

        return redirect()->route('all.subCategory')
            ->with($notification);
    }

    public function subCategoryDelete($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        $notification = array(
            'message' => 'サブカテゴリー：' . $subCategory->subCategory_name_ja . 'を削除しました。',
            'alert-type' => 'error',
        );

        return redirect()->back()
            ->with($notification);
    }
}
