<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use App\Models\subcategory;
use App\Models\thumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Str;
use Image;

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
        // IF Product Thumbnail is empty
        if($request->product_thumbnail == "")
        {
            $category_name = category::find($request->category_id)->category_name;

            $product_id = product::insertGetId([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_discount' => $request->product_discount,
                'discount_price' => $request->product_price - $request->product_price * ($request->product_discount/100),
                'short_desp' => $request->short_desp,
                'long_desp' => $request->long_desp,
                'slug' => Str::lower($category_name) . '-' . str_replace(' ', '-', Str::lower($request->product_name)). rand(0, 100),
                'sku' => substr($request->product_name, 0, 5) .'-'. substr(Uniqid(),0,6),
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);
    
    
            $product_image = $request->product_preview;
            $extension = $product_image->getClientOriginalExtension();
            $file_name = $product_id.".".$extension;
            
            Image::make($product_image)->resize(620, 780)->save(public_path('/frontend/assets/img/product/previews/'.$file_name));
    
    
            product::find($product_id)->update([
                'product_preview' => $file_name,
            ]);

            return back()->with('success', 'Product added successfully!');
        }
        // Else Product Thumbnail is not empty
        else
        {
            $thumbnail_count = 0;
            foreach($request->product_thumbnail as $counts){$thumbnail_count++;}
            // If Thumbnail are more than 4
            if($thumbnail_count > 4)
            {
                return back()->with('error', 'You can select only 4 images!');
            }
            // Else thumbnail are less than 4
            else
            {
                $category_name = category::find($request->category_id)->category_name;

                $product_id = product::insertGetId([
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'product_name' => $request->product_name,
                    'product_price' => $request->product_price,
                    'product_discount' => $request->product_discount,
                    'discount_price' => $request->product_price - $request->product_price * ($request->product_discount/100),
                    'short_desp' => $request->short_desp,
                    'long_desp' => $request->long_desp,
                    'slug' => Str::lower($category_name) . '-' . str_replace(' ', '-', Str::lower($request->product_name)). rand(0, 100),
                    'sku' => substr($request->product_name, 0, 6) . '-' . substr(Uniqid(),0,6),
                    'created_by' => Auth::id(),
                    'created_at' => Carbon::now(),
                ]);
        
        
                $product_image = $request->product_preview;
                $extension = $product_image->getClientOriginalExtension();
                $file_name = $product_id.".".$extension;
                
                Image::make($product_image)->resize(620, 780)->save(public_path('/frontend/assets/img/product/previews/'.$file_name));
        
        
                product::find($product_id)->update([
                    'product_preview' => $file_name,
                ]);
        
                $sl = 1;
                foreach($request->product_thumbnail as $key => $thumb)
                {
                    $product_thumbnail = $thumb;
                    $thumbnail_extension = $product_thumbnail->getClientOriginalExtension();
                    $file_name = $product_id. "-" . $sl++ .".".$thumbnail_extension;
        
                    Image::make($product_thumbnail)->resize(620, 780)->save(public_path('/frontend/assets/img/product/thumbnails/'.$file_name));
        
                    thumbnail::insert([
                        'product_id' => $product_id,
                        'product_thumbnail' => $file_name,
                    ]);
                }
                return back()->with('success', 'Product added successfully!');
            }
        }
    }

    function product_list()
    {
        $products = product::all();
        return view('admin.products.products_list',[
            'products' => $products,
        ]);
    }

    function product_details($product_slug)
    {
        $products = product::where('slug',$product_slug)->get();
        $thumb = thumbnail::where('product_id',$products->first()->id)->get();
        return view('admin.products.product_details',[
            'products' => $products,
            'thumb' => $thumb,
        ]);
    }

    function product_edit_name($product_id)
    {
        $product_information = product::find($product_id)->get();
        $edit_type = 1;
        return view('admin.products.product_edit',[
            'product_information' => $product_information,
            'edit_type' => $edit_type,
        ]);
    }
    function product_edit_category($product_id)
    {
        $product_information = product::find($product_id)->get();
        $category = category::all();
        $edit_type = 2;
        return view('admin.products.product_edit',[
            'product_information' => $product_information,
            'edit_type' => $edit_type,
            'category' => $category,
        ]);
    }
}
