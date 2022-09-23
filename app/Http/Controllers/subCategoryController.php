<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class subCategoryController extends Controller
{
    // View ADD Sub-Category Page
    function subCategory_add()
    {
        $categories = category::all();
        return view('admin.sub_category.add_subcategory',[
            'categories' => $categories,
        ]);
    }
    // Store ADD Sub-Category Data
    function subCategory_store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required|unique:subcategories',
        ],
        [
            'category_id.required' => 'The Category name field is required.',
            'subcategory_name.required' => 'The Sub-Category name field is required.',
            'subcategory_name.unique' => 'The Sub-Category name taken.',
        ]
        );

        subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'created_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Sub-Category Added Successfully');
    }
    // View ADD Sub-Category List
    function subCategory_list()
    {
        $subcategories = subcategory::all();
        $categories = category::all();

        return view('admin.sub_category.view_subcategory',[
            'subcategories' => $subcategories,
            'categories' => $categories,
        ]);
    }
    // Trash Category
    function subcategory_soft_delete($subcategory_id)
    {
        subcategory::find($subcategory_id)->delete();

        return back()->with('soft_delete', 'Sub-Category has been moved to trash!');
    }

    // View Trashed List
    function subcategory_trash()
    {
        $subcategories = subcategory::onlyTrashed()->get();

        return view('admin.sub_category.trash_subcategory',[
            'subcategories' => $subcategories,
        ]);
    }

    // Restore Category
    function category_restore($category_id)
    {
        category::onlyTrashed()->find($category_id)->restore();

        return back()->with('restore', 'Category has been restored!');
    }

    // Permanent Delete Category
    function category_delete($category_id)
    {
        $catgories = category::onlyTrashed()->find($category_id);
        $image_name = $catgories->category_image;
        $delete_previous_image_from = public_path('/frontend/assets/img/categories/').$image_name;
        unlink($delete_previous_image_from);

        $catgories->forceDelete();

        return back()->with('delete', 'Category has deleted permanently!');
    }
}
