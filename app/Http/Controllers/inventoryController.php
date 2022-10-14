<?php

namespace App\Http\Controllers;

use App\Models\inventoryColors;
use App\Models\inventorySize;
use Carbon\Carbon;
use Illuminate\Http\Request;

class inventoryController extends Controller
{
    function inventory_color()
    {
        $inventoryColors = inventoryColors::all();
        return view('admin.inventory.add_color_inventory',[
            'inventoryColors' => $inventoryColors,
        ]);
    }
    function inventory_add_color(Request $request)
    {
        inventoryColors::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
        ]);
        
        return back()->with('success' , 'New Color Added');
    }
    function remove_ineventory_color($color_id)
    {
        inventoryColors::find($color_id)->delete();
        
        return back()->with('success' , 'Color deleted');
    }
    function inventory_size()
    {
        $inventorySize = inventorySize::all();
        return view('admin.inventory.add_size_inventory',[
            'inventorySize' => $inventorySize,
        ]);
    }
    function inventory_add_size(Request $request)
    {
        inventorySize::insert([
            'size_name' => $request->size_name,
            'size_short_name' => $request->size_short_name,
            'created_at' => Carbon::now(),
        ]);
        
        return back()->with('success' , 'New Size Added');
    }
    function remove_ineventory_size($size_id)
    {
        inventorySize::find($size_id)->delete();
        
        return back()->with('success' , 'Size deleted');
    }
}
