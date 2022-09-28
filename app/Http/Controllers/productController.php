<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class productController extends Controller
{
    function product_add()
    {
        return view('admin.products.product_add');
    }
}
