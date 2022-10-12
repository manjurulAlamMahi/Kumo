<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    function rel_to_user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    function rel_to_category()
    {
        return $this->belongsTo(category::class, 'category_id');
    }
    
    function rel_to_subcategory()
    {
        return $this->belongsTo(subcategory::class, 'subcategory_id');
    }
}
