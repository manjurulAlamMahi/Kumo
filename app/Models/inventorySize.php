<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventorySize extends Model
{
    use HasFactory;

    function rel_to_size_type()
    {
        return $this->belongsTo(inventorySizeType::class, 'size_type');
    }
}
