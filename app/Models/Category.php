<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    // Danh mục con
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Danh mục cha
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
