<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\subcategory;
use Illuminate\Http\Request;

class productController extends Controller
{
    function product_add()
    {
        $catrgories = category::all();
        $subcategories = subcategory::all();
        return view('admin.products.product_add',[
            'catrgories' => $catrgories,
            'subcategories' => $subcategories,
        ]);
    }

    function getsubcategory(Request $request)
    {
        $subcategories = subcategory::where('category_id', $request->category_id)->get();
        $str = '<option value="">-- Select Sub-Category --</option>';
        foreach($subcategories as $subcategory){
            $str.= '<option value="'. $subcategory->id .'">'. $subcategory->subcategory_name .'</option>';
        }
        echo $str;
    }

    function product_store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'short_desp' => 'required',
            'long_desp' => 'required',
            'product_preview' => 'required',
        ],
        [
            'category_id.required' => 'Please enter product category.',
            'product_name.required' => 'Please enter name of product.',
            'product_price.required' => 'Please enter product price.',
            'short_desp.required' => 'Please enter short desciption about product.',
            'long_desp.required' => 'Please enter long desciption about product.',
            'product_preview.required' => 'Please enter product image.',
        ]
        );
    }
}
