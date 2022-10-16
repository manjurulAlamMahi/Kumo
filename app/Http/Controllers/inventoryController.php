<?php

namespace App\Http\Controllers;

use App\Models\inventoryColors;
use App\Models\inventorySizeType;
use App\Models\inventorySize;
use App\Models\productInventory;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class inventoryController extends Controller
{
    // ###################### Inventory Color
    function inventory_color()
    {
        $inventoryColors = inventoryColors::all();
        return view('admin.inventory.add_color_inventory',[
            'inventoryColors' => $inventoryColors,
        ]);
    }
    // ###################### Inventory Color Add
    function inventory_add_color(Request $request)
    {
        inventoryColors::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
        ]);
        
        return back()->with('success' , 'New Color Added');
    }
    // ###################### Inventory Color Remove
    function remove_ineventory_color($color_id)
    {
        inventoryColors::find($color_id)->delete();
        
        return back()->with('success' , 'Color deleted');
    }
    // ###################### Inventory Size
    function inventory_size(Request $request)
    {
        $data = $request->all();
        
        $inventorySize = inventorySize::where(function($search) use ($data){
            // Search By Size Type 
            if(!empty($data['size_type']) && $data['size_type'] != '' && $data['size_type'] != "undefined")
            {
                $search->where(function($search) use ($data){
                    $search->where('size_type', $data['size_type']);
                });
            }
        });
        $inventorySizeType = inventorySizeType::all();
        return view('admin.inventory.add_size_inventory',[
            'inventorySizeType' => $inventorySizeType,
            'inventorySize' => $inventorySize->paginate(10),
        ]);
    }
    // ###################### Inventory Size Type
    function inventory_add_size_type(Request $request)
    {
        $request->validate([
            'size_type_name' => 'required',
        ],
        [
            'size_type_name.required' => 'Please enter size type name.',
        ]
        );
        inventorySizeType::insert([
            'size_type' => $request->size_type_name,
        ]);
        return back()->with('success' , 'New Size Type Added');
    }
    // ###################### Inventory Size Type Remove
    function remove_size_type($szt_id)
    {
        inventorySizeType::find($szt_id)->delete();
        return back()->with('success' , 'Size Type Deleted');
    }
    // ###################### Inventory Add Size
    function inventory_add_size(Request $request)
    {
        $request->validate([
            'size_type' => 'required',
            'size_name' => 'required',
        ],
        [
            'size_type.required' => 'Please enter size type.',
            'size_name.required' => 'Please enter size name.',
        ]
        );
        inventorySize::insert([
            'size_type' => $request->size_type,
            'size_name' => $request->size_name,
            'created_at' => Carbon::now(),
        ]);
        
        return back()->with('success' , 'New Size Added');
    }
    // ###################### Inventory Size Remove
    function remove_ineventory_size($size_id)
    {
        inventorySize::find($size_id)->delete();
        
        return back()->with('success' , 'Size deleted');
    }
    // ###################### Inventory 
    function product_inventory($product_slug)
    {
        $product_details = product::where('slug' , $product_slug);
        $inventorySizeType = inventorySizeType::all();
        $colors = inventoryColors::all();
        $productInventory = productInventory::where('product_id', $product_details->first()->id)->get();
        return view('admin.inventory.product_inventory_add',[
            'product_details' => $product_details,
            'inventorySizeType' => $inventorySizeType,
            'productInventory' => $productInventory,
            'colors' => $colors,
        ]);
    }
    // ################### Get inventory size
    function getsizeinventory(Request $request)
    {
        $size_type = inventorySize::where('size_type', $request->size_type)->get();
        if($request->size_type == "")
        {
            $str = '<br> <input checked type="checkbox" name="size_id[]" value=""> No Size Available <br>';
        }
        else
        {
            $str = '<br>';
        }
        foreach($size_type as $size){
            $str.= '<input type="checkbox" name="size_id[]" value="'. $size->id .'"> '. $size->size_name .' <br> ';
        }
        echo $str;
    }
    // ###################  inventory Store
    function store_inventory(Request $request)
    {
        $request->validate([
            'quantity' => 'required',
        ],
        [
            'quantity.required' => 'Please enter quantity.',
        ]
        );
        $prodcut_id = $request->product_id;
        $color_id = $request->color_id;
        $size_id = $request->size_id;
        $quantity = $request->quantity;

        if($size_id == "")
        {
            if(productInventory::where('product_id' , $prodcut_id)->where('color_id' , $color_id)->where('size_id' , $size_id)->exists())
            {
                foreach($size_id as $size){
                    productInventory::where('product_id' , $prodcut_id)->where('color_id' , $color_id)->where('size_id' , $size)->increment('quantity' , $quantity);
                }
                return back()->with('success', 'Inventory have been increase');
            }
            else{
                productInventory::insert([
                    'product_id' => $prodcut_id,
                    'color_id' => $color_id,
                    'size_id' => $size_id,
                    'quantity' => $quantity,
                    'created_at' => Carbon::now(),
                ]);

                return back()->with('success', 'Inventory have been added');
            }
        }
        else
        {
            foreach($size_id as $sizes){
                if(productInventory::where('product_id' , $prodcut_id)->where('color_id' , $color_id)->where('size_id' , $sizes)->exists()){
                    productInventory::where('product_id' , $prodcut_id)->where('color_id' , $color_id)->where('size_id' , $sizes)->increment('quantity' , $quantity);
                }
                else{
                    productInventory::insert([
                        'product_id' => $prodcut_id,
                        'color_id' => $color_id,
                        'size_id' => $sizes,
                        'quantity' => $quantity,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }
            return back()->with('success', 'Inventory have been increase');        
        } 
    }
    // ################### Remove Invetory
    function remove_product_inventory($inventory_id)
    {
        productInventory::find($inventory_id)->delete();
        return back()->with('success' , 'Deleted');
    }
}
