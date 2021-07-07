<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name_ja',
        'category_name_en',
        'category_slug_ja',
        'category_slug_en',
        'category_icon',
    ];
}
