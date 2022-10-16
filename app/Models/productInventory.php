<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productInventory extends Model
{
    use HasFactory;

    function rel_to_product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
    function rel_to_size()
    {
        return $this->belongsTo(inventorySize::class, 'size_id');
    }
    function rel_to_color()
    {
        return $this->belongsTo(inventoryColors::class, 'color_id');
    }
}
