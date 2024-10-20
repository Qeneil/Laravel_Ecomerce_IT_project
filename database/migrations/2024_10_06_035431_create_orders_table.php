<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('name');  // เพิ่มคอลัมน์ name
            $table->string('address');  // เพิ่มคอลัมน์ address
            $table->string('phone');  // เพิ่มคอลัมน์ phone
            $table->dateTime('order_date')->useCurrent(); 
            $table->decimal('total_amount', 10, 2);
            $table->enum('order_status', ['Pending', 'Paid', 'Shipped'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
    
}
