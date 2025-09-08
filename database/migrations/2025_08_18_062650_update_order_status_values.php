<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        DB::table('orders')->where('status', 'Chờ xử lý')->update(['status' => 'pending']);
        DB::table('orders')->where('status', 'Hoàn thành')->update(['status' => 'completed']);
        DB::table('orders')->where('status', 'Hủy')->update(['status' => 'canceled']);
        DB::table('orders')->whereNull('status')->update(['status' => 'cart']);
    }

    public function down()
    {
        // Rollback về dữ liệu cũ
        DB::table('orders')->where('status', 'pending')->update(['status' => 'Chờ xử lý']);
        DB::table('orders')->where('status', 'completed')->update(['status' => 'Hoàn thành']);
        DB::table('orders')->where('status', 'canceled')->update(['status' => 'Hủy']);
        DB::table('orders')->where('status', 'cart')->update(['status' => null]);
    }
};
