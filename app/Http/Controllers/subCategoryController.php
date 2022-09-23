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
    function subcategory_restore($subcategory_id)
    {
        subcategory::onlyTrashed()->find($subcategory_id)->restore();

        return back()->with('restore', 'Sub-category has been restored!');
    }

    // Permanent Delete Category
    function subcategory_delete($subcategory_id)
    {
        subcategory::onlyTrashed()->find($subcategory_id)->forceDelete();

        return back()->with('delete', 'Sub-category has deleted permanently!');
    }

    // Permanent Delete Category
    function subcategory_delete_mark(Request $request)
    {
        foreach($request->mark as $mark)
        {
            subcategory::onlyTrashed()->find($mark)->forceDelete();
        }
        return back()->with('delete', 'Sub-Category has deleted permanently!');
    }

    // View Edit Subcategory Page 
    function subcategory_edit($subcategory_id)
    {
        $subcategoires = subcategory::find($subcategory_id);
        $categories = category::all();
        return view('admin.sub_category.edit_subcategory',[
            'categories' => $categories,
            'subcategoires' => $subcategoires,
        ]);
    }

    // Update Subcategory
    function subcategory_update(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ],
        [
            'category_id.required' => 'The Category name field is required.',
            'subcategory_name.required' => 'The Sub-Category name field is required.',
        ]
        );

        subcategory::find($request->subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'updated_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Sub-Category Updated Successfully');
    }
}
