<?php

namespace App\Http\Controllers;

use App\Models\inventoryColors;
use App\Models\inventorySizeType;
use App\Models\inventorySize;
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
        return view('admin.inventory.product_inventory_add');
    }
}
