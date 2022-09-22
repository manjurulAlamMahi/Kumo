<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Carbon;

class categoryController extends Controller
{
    // View add category
    function category_add()
    {
        return view('admin.category.add_category');
    }
    
    // Add/Store Category
    function category_store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories',
            'category_image' => 'required',
        ]);
        
        $category_id = category::insertGetId([
            'category_name' => $request->category_name,
            'category_icon' => $request->category_icon,
            'created_by' => Auth::id(),
        ]);

        $catetory_image = $request->category_image;
        $extension = $catetory_image->getClientOriginalExtension();
        $file_name = $category_id.".".$extension;
        
        Image::make($catetory_image)->resize(128, 128)->save(public_path('/frontend/assets/img/categories/'.$file_name));

        category::find($category_id)->update([
            'category_image' => $file_name,
            'created_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Category Added Successfully');
    }

    // View Category list
    function category_view()
    {
        $categories = category::all();

        return view('admin.category.view_category',[
            'categories' => $categories,
        ]);
    }

    // Trash Category
    function category_soft_delete($category_id)
    {
        category::find($category_id)->delete();

        return back()->with('soft_delete', 'Category has been moved to trash!');
    }

    // View Trashed List
    function category_trash()
    {
        $categories = category::onlyTrashed()->get();

        return view('admin.category.trash_category',[
            'categories' => $categories,
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

    // Marked Permanent Delete Category
    function category_delete_mark(Request $request)
    {
        foreach($request->mark as $mark)
        {
            $catgories = category::onlyTrashed()->find($mark);
            $image_name = $catgories->category_image;
            $delete_previous_image_from = public_path('/frontend/assets/img/categories/').$image_name;
            unlink($delete_previous_image_from);

            $catgories->forceDelete();
        }
        return back()->with('delete', 'Category has deleted permanently!');
    }

    // Edit Category
    function category_edit($category_id)
    {
        $categories = category::find($category_id);

        return view('admin.category.edit_category',[
            'categories' => $categories,
        ]);
    }

    // Update Category
    function category_update(Request $request)
    {
        $catgories = category::find($request->category_id);
        $image_name = $catgories->category_image;

        if($request->category_image == "")
        {
            $request->validate([
                'category_name' => 'required',
            ]);

            category::find($request->category_id)->update([
                'category_name' => $request->category_name,
                'category_icon' => $request->category_icon,
                'updated_at' => Carbon::now(),
            ]);

            return back()->with('success', 'Category Updated Successfully');
        }
        else
        {
            $request->validate([
                'category_name' => 'required',
                'category_image' => 'required',
            ]);

            $delete_previous_image_from = public_path('/frontend/assets/img/categories/').$image_name;
            unlink($delete_previous_image_from);

            $catetory_image = $request->category_image;
            $extension = $catetory_image->getClientOriginalExtension();
            $file_name = $request->category_id.".".$extension;
            
            Image::make($catetory_image)->resize(128, 128)->save(public_path('/frontend/assets/img/categories/'.$file_name));

            category::find($request->category_id)->update([
                'category_name' => $request->category_name,
                'category_icon' => $request->category_icon,
                'category_image' => $file_name,
                'updated_at' => Carbon::now(),
            ]);
            
            return back()->with('success', 'Category Updated Successfully');
        }
    }
}
