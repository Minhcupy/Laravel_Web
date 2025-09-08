<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_promotions_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete();
            $table->decimal('discount_percentage', 5, 2);   // ví dụ 10.50 = 10.5%
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();
        });

        // CHECK constraint (MySQL 8+ tôn trọng; nếu DB cũ bỏ qua cũng không sao —
        // ta vẫn validate ở Controller).
        DB::statement('
            ALTER TABLE promotions
            ADD CONSTRAINT chk_discount_percentage
            CHECK (discount_percentage >= 0 AND discount_percentage <= 100)
        ');
        DB::statement('
            ALTER TABLE promotions
            ADD CONSTRAINT chk_dates
            CHECK (start_date <= end_date)
        ');
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};

