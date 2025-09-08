<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'discount_percentage',
        'start_date',
        'end_date',
    ];

    // Quan hệ (tuỳ bạn dùng hay không)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Để Eloquent tự convert về Carbon
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    /**
     * Scope khuyến mãi còn hiệu lực.
     * So sánh theo NGÀY để tránh lệch múi giờ/giây.
     */
    public function scopeActive($q, $at = null)
    {
        $today = ($at ?? now())->toDateString(); // YYYY-MM-DD (theo app timezone)
        return $q->whereDate('start_date', '<=', $today)
                 ->whereDate('end_date',   '>=', $today);
    }
}
