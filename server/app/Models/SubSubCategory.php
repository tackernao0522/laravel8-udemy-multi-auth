<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subCategory_id',
        'subSubCategory_name_ja',
        'subSubCategory_name_en',
        'subSubCategory_slug_ja',
        'subSubCategory_slug_en',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subCategory_id', 'id');
    }
}
