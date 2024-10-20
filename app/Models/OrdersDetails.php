<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersDetails extends Model
{
    use HasFactory;

    protected $table = 'order_details'; // ตั้งชื่อของตาราง
    protected $primaryKey = 'order_detail_id'; // กำหนด primary key
    public $timestamps = true; // ถ้าคุณใช้ timestamps ให้ตั้งค่าเป็น true

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // ความสัมพันธ์กับ Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    // ความสัมพันธ์กับ Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
