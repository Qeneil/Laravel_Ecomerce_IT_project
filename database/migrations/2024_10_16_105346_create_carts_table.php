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
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // เชื่อมโยงกับผู้ใช้
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade'); // เชื่อมโยงกับ products โดยใช้ 'product_id'
            $table->integer('quantity')->default(1); // จำนวนสินค้าในตะกร้า
            $table->timestamps(); // เวลาที่สร้างและปรับปรุง
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
