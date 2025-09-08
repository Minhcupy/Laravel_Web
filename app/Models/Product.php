<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'image'
    ];

    // 1 sản phẩm thuộc về 1 danh mục
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Quan hệ: 1 sản phẩm có 1 khuyến mại đang chạy
    public function promotion()
    {
        return $this->hasOne(Promotion::class, 'product_id')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->latestOfMany();
    }

    // Giá sau giảm
    public function getDiscountedPriceAttribute()
    {
        if ($this->promotion) {
            return round($this->price * (1 - $this->promotion->discount_percentage / 100));
        }
        return $this->price;
    }

    // 1 sản phẩm có nhiều đánh giá
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    // Điểm trung bình đánh giá
    public function averageRating()
    {
        return round($this->reviews()->avg('rating'), 1); // vd: 4.3 sao
    }
}
