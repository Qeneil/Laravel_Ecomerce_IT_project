<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // ใช้ InnoDB Engine
            $table->id('order_detail_id'); // Primary Key
            $table->foreignId('order_id')->constrained('orders', 'order_id')->onDelete('cascade'); // เชื่อมโยงกับ orders
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade'); // เชื่อมโยงกับ products
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
