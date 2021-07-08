<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

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
            'message' => 'サブカテゴリーID：' . $subCategory->id . 'を更新しました(SubCategory Updated Successfully)。',
            'alert-type' => 'info',
        );

        return redirect()->route('all.subCategory')
            ->with($notification);
    }

    public function subCategoryDelete($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();
        if (SubSubCategory::where('subCategory_id', $subCategory->id)->first()) {
            $subSubCategory = SubSubCategory::where('subCategory_id', $subCategory->id)->first();
            $subSubCategory->delete();
        }

        $notification = array(
            'message' => 'サブカテゴリー：' . $subCategory->subCategory_name_ja . 'を削除しました。',
            'alert-type' => 'error',
        );

        return redirect()->back()
            ->with($notification);
    }

    // That for SUB SUB->SUBCATEGORY
    public function subSubCategoryView()
    {
        $categories = Category::orderBy('category_name_ja', 'ASC')->get();
        $subSubCategories = SubSubCategory::latest()->get();

        return view('backend.category.sub_subCategory_view', compact('subSubCategories', 'categories'));
    }

    public function getSubCategory($category_id)
    {
        $subCat = SubCategory::where('category_id', $category_id)
            ->orderBy('subCategory_name_ja', 'ASC')->get();

        return json_encode($subCat);
    }

    public function getSubSubCategory($subCategory_id)
    {
        $subSubCat = SubSubCategory::where('subCategory_id', $subCategory_id)
            ->orderBy('subSubCategory_name_ja', 'ASC')->get();

        return json_encode($subSubCat);
    }

    public function subSubCategoryStore(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subCategory_id' => 'required',
            'subSubCategory_name_ja' => 'required',
            'subSubCategory_name_en' => 'required',
        ], [
            'category_id.required' => 'メインカテゴリーを選択してください。(Please select Any option.)',
            'subCategory_id.required' => 'サブカテゴリーを選択してください。(Please select Any option.)',
            'subSubCategory_name_en.required' => 'Input G-ChildCategory English Name.',
        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subCategory_id' => $request->subCategory_id,
            'subSubCategory_name_ja' => $request->subSubCategory_name_ja,
            'subSubCategory_name_en' => $request->subSubCategory_name_en,
            'subSubCategory_slug_ja' => str_replace(' ', '-', $request->subSubCategory_name_ja),
            'subSubCategory_slug_en' => strtolower(str_replace(' ', '-', $request->subSubCategory_name_en)),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '孫カテゴリーを作成しました。(G-ChildCategory Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function subSubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_ja', 'ASC')->get();
        $subCategories = SubCategory::orderBy('subCategory_name_ja', 'ASC')->get();
        $subSubCategory = SubSubCategory::findOrFail($id);

        return view('backend.category.subSubCategory_edit', compact('categories', 'subCategories', 'subSubCategory'));
    }

    public function subSubCategoryUpdate(Request $request, $id)
    {
        $subSubCategory = SubSubCategory::findOrFail($id);
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subCategory_id' => 'required',
            'subSubCategory_name_ja' => 'required',
            'subSubCategory_name_en' => 'required',
        ], [
            'category_id.required' => 'メインカテゴリーを選択してください。(Please select Any option.)',
            'subCategory_id.required' => 'サブカテゴリーを選択してください。(Please select Any option.)',
            'subSubCategory_name_en.required' => 'Input G-ChildCategory English Name.',
        ]);

        $subSubCategory->category_id = $request->category_id;
        $subSubCategory->subCategory_id = $request->subCategory_id;
        $subSubCategory->subSubCategory_name_ja = $request->subSubCategory_name_ja;
        $subSubCategory->subSubCategory_name_en = $request->subSubCategory_name_en;
        $subSubCategory->subSubCategory_slug_ja = str_replace(' ', '-', $request->subSubCategory_name_ja);
        $subSubCategory->subSubCategory_slug_en = strtolower(str_replace(' ', '-', $request->subSubCategory_name_en));
        $subSubCategory->save();

        $notification = array(
            'message' => '孫カテゴリーID：' . $subSubCategory->id . 'を更新しました(G-ChildCategory Updated Successfully)。',
            'alert-type' => 'info',
        );

        return redirect()->route('all.subSubCategory')
            ->with($notification);
    }

    public function subSubCategoryDelete($id)
    {
        $subSubCategory = SubSubCategory::findOrFail($id);
        $subSubCategory->delete();

        $notification = array(
            'message' => '孫カテゴリー：' . $subSubCategory->subSubCategory_name_ja . 'を削除しました。',
            'alert-type' => 'error',
        );

        return redirect()->back()
            ->with($notification);
    }
}
