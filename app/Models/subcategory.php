<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    function rel_to_category()
    {
        return $this->belongsTo(category::class, 'category_id');
    }

    function rel_to_user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
