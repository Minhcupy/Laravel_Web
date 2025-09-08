<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'user_id' => 1,
            'name'    => 'Nguyễn Văn A',
            'phone'   => '0901234567',
            'address' => 'Hà Nội',
            'total'   => 500000,
            'status'  => Order::STATUS_PENDING,
        ]);

        Order::create([
            'user_id' => 1,
            'name'    => 'Trần Thị B',
            'phone'   => '0912345678',
            'address' => 'Hồ Chí Minh',
            'total'   => 300000,
            'status'  => Order::STATUS_COMPLETED,
        ]);
    }
}
