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
                'sku' => substr($request->product_name, 0, 5) .'-'. substr(Uniqid(),0,4),
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
        $product_information = product::find($product_id);
        $edit_type = 1;
        return view('admin.products.product_edit',[
            'product_information' => $product_information,
            'edit_type' => $edit_type,
        ]);
    }
    function product_edit_category($product_id)
    {
        $product_information = product::find($product_id);
        $category = category::all();
        $edit_type = 2;
        return view('admin.products.product_edit',[
            'product_information' => $product_information,
            'edit_type' => $edit_type,
            'category' => $category,
        ]);
    }
    function product_edit_subcategory($product_id)
    {
        $product_information = product::find($product_id);
        $category_id = product::find($product_id)->category_id;
        $subcategory = subcategory::where('category_id', $category_id)->get();
        $edit_type = 3;
        return view('admin.products.product_edit',[
            'product_information' => $product_information,
            'edit_type' => $edit_type,
            'subcategory' => $subcategory,
        ]);
    }
    function product_edit_price($product_id)
    {
        $product_information = product::find($product_id);
        $edit_type = 4;
        return view('admin.products.product_edit',[
            'product_information' => $product_information,
            'edit_type' => $edit_type,
        ]);
    }
    function product_edit_short_desp($product_id)
    {
        $product_information = product::find($product_id);
        $edit_type = 5;
        return view('admin.products.product_edit',[
            'product_information' => $product_information,
            'edit_type' => $edit_type,
        ]);
    }
    function product_edit_long_desp($product_id)
    {
        $product_information = product::find($product_id);
        $edit_type = 6;
        return view('admin.products.product_edit',[
            'product_information' => $product_information,
            'edit_type' => $edit_type,
        ]);
    }
    function product_edit_preview($product_id)
    {
        $product_information = product::find($product_id);
        $edit_type = 7;
        return view('admin.products.product_edit',[
            'product_information' => $product_information,
            'edit_type' => $edit_type,
        ]);
    }

    function product_image_list($product_id)
    {
        $product_information = product::find($product_id);
        $product_thumbnails = thumbnail::where('product_id', $product_id)->get();
        return view('admin.products.product_images_list',[
            'product_information' => $product_information,
            'product_thumbnails' => $product_thumbnails,
        ]);
    }

    function insert_new_thumbnail(Request $request)
    {
        $thumbnail = thumbnail::where('product_id', $request->product_id);
        
        if($thumbnail->count() < 4)
        {
            $product_thumbnail = $request->insert_thumbnail;
            $thumbnail_extension = $product_thumbnail->getClientOriginalExtension();
            $old_name_check_1 = $request->product_id. "-" . 1 .".".$thumbnail_extension;
            $old_name_check_2 = $request->product_id. "-" . 2 .".".$thumbnail_extension;
            $old_name_check_3 = $request->product_id. "-" . 3 .".".$thumbnail_extension;
            $old_name_check_4 = $request->product_id. "-" . 4 .".".$thumbnail_extension;
            if(!thumbnail::where('product_id', $request->product_id)->where('product_thumbnail', $old_name_check_1)->exists()){
                $sl = 1;
            }
            else if(!thumbnail::where('product_id', $request->product_id)->where('product_thumbnail', $old_name_check_2)->exists()){
                $sl = 2;
            }
            else if(!thumbnail::where('product_id', $request->product_id)->where('product_thumbnail', $old_name_check_3)->exists()){
                $sl = 3;
            }
            else if(!thumbnail::where('product_id', $request->product_id)->where('product_thumbnail', $old_name_check_4)->exists()){
                $sl = 4;
            }

            $file_name = $request->product_id. "-" . $sl .".".$thumbnail_extension;
            

            Image::make($product_thumbnail)->resize(620, 780)->save(public_path('/frontend/assets/img/product/thumbnails/'.$file_name));

            thumbnail::insert([
                'product_id' => $request->product_id,
                'product_thumbnail' => $file_name,
            ]);
            return back()->with('success', 'New Thumbnail Added Successfully!');
        }
        else{
            return back();
        }
        
    }

    function remove_thumbnail($thumbnail_id)
    {
        $thumbnail = thumbnail::find($thumbnail_id);
        $image_name = $thumbnail->product_thumbnail;
        $delete_previous_image_from = public_path('/frontend/assets/img/product/thumbnails/').$image_name;
        unlink($delete_previous_image_from);
        $thumbnail->delete();

        return back()->with('success', 'Thumbnail deleted successfully!');
    }

    function product_update(Request $request)
    {
        $edit_type =  $request->edit_type;
        $product_id =  $request->product_id;
        // Product Name Update
        if($edit_type == 1)
        {
            $request->validate([
                'product_name' => 'required',
            ],
            [
                'product_name.required' => 'Please enter product name.',
            ]
            );
            product::find($product_id)->update([
                'product_name' => $request->product_name,
                'sku' => substr($request->product_name, 0, 5) .'-'. substr(Uniqid(),0,4),
                'updated_at' => Carbon::now(),
            ]);

            return back()->with('success', 'Product name updated successfully');
        }
        // Product Category Update
        else if($edit_type == 2)
        {
            $request->validate([
                'category_id' => 'required',
            ],
            [
                'category_id.required' => 'Please enter product category.',
            ]
            );
            product::find($product_id)->update([
                'category_id' => $request->category_id,
                'subcategory_id' => null,
                'updated_at' => Carbon::now(),
            ]);

            return back()->with('success', 'Product category updated successfully');
        }
        // Product Sub-Category Update
        else if($edit_type == 3)
        {
            $request->validate([
                'subcategory_id' => 'required',
            ],
            [
                'subcategory_id.required' => 'Please enter product subcategory.',
            ]
            );
            product::find($product_id)->update([
                'subcategory_id' => $request->subcategory_id,
                'updated_at' => Carbon::now(),
            ]);

            return back()->with('success', 'Product subcategory updated successfully');
        }
        // Product Price Update
        else if($edit_type == 4)
        {
            $request->validate([
                'product_price' => 'required',
            ],
            [
                'product_price.required' => 'Please enter product price.',
            ]
            );
            product::find($product_id)->update([
                'product_price' => $request->product_price,
                'product_discount' => $request->product_discount,
                'discount_price' => $request->product_price - $request->product_price * ($request->product_discount/100),
                'updated_at' => Carbon::now(),
            ]);
            
            return back()->with('success', 'Product price updated successfully');
        }
        // Product Short Description Update
        else if($edit_type == 5)
        {
            $request->validate([
                'short_desp' => 'required',
            ],
            [
                'short_desp.required' => 'Please enter product short description.',
            ]
            );
            product::find($product_id)->update([
                'short_desp' => $request->short_desp,
                'updated_at' => Carbon::now(),
            ]);
            
            return back()->with('success', 'Product  short description updated successfully');
        }
        // Product Long Description Update
        else if($edit_type == 6)
        {
            $request->validate([
                'long_desp' => 'required',
            ],
            [
                'long_desp.required' => 'Please enter product long description.',
            ]
            );

            product::find($product_id)->update([
                'long_desp' => $request->long_desp,
                'updated_at' => Carbon::now(),
            ]);
            
            return back()->with('success', 'Product  long description updated successfully');
        }
        // Product Preview Update
        else if($edit_type == 7)
        {
            $request->validate([
                'product_preview' => 'required',
            ],
            [
                'product_preview.required' => 'Please enter product preview.',
            ]
            );

            $product_image = $request->product_preview;
            $extension = $product_image->getClientOriginalExtension();
            $file_name = $product_id.".".$extension;
            $delete_previous_image_from = public_path('/frontend/assets/img/product/previews/').$file_name;
            unlink($delete_previous_image_from);

            Image::make($product_image)->resize(620, 780)->save(public_path('/frontend/assets/img/product/previews/'.$file_name));

            product::find($product_id)->update([
                'product_preview' => $file_name,
                'updated_at' => Carbon::now(),
            ]);
            
            return back()->with('success', 'Product product preview updated successfully');
        }
        

    }
}
