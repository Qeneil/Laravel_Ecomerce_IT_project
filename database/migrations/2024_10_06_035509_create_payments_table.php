<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // ใช้ InnoDB Engine
            $table->id('payment_id'); // Primary Key
            $table->foreignId('order_id')->constrained('orders', 'order_id')->onDelete('cascade'); // เชื่อมโยงกับ orders
            $table->dateTime('payment_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('payment_amount', 10, 2);
            $table->enum('payment_method', ['Credit Card', 'Bank Transfer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
