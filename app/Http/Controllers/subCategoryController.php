<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class subCategoryController extends Controller
{
    // View ADD Category Page
    function subCategory_add()
    {
        $categories = category::all();
        return view('admin.sub_category.add_subcategory',[
            'categories' => $categories,
        ]);
    }
    // Store ADD Category Data
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
}
