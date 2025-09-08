<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [ 'user_id', 'name', 'phone', 'address', 'total',
    'payment_method', 'status'];

    // Định nghĩa các trạng thái chuẩn
    const STATUS_CART      = 'cart';
    const STATUS_PENDING   = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED  = 'canceled';

    // Quan hệ: 1 đơn hàng có nhiều item
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Hàm tiện ích: đổi status thành text dễ đọc
    public static function getStatusText($status)
    {
        return [
            self::STATUS_CART      => 'Trong giỏ hàng',
            self::STATUS_PENDING   => 'Chờ xử lý',
            self::STATUS_COMPLETED => 'Hoàn thành',
            self::STATUS_CANCELED  => 'Hủy',
        ][$status] ?? $status;
    }

    // Accessor: có thể gọi $order->status_text trực tiếp trong Blade
    public function getStatusTextAttribute()
    {
        return self::getStatusText($this->status);
    }
}
