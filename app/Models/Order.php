<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // ตั้งชื่อของตาราง
    protected $primaryKey = 'order_id'; // กำหนด primary key
    public $timestamps = true; // ถ้าคุณใช้ timestamps ให้ตั้งค่าเป็น true

    protected $fillable = [
        'user_id', 'name', 'address', 'phone', 'total_amount', 'payment_method', 'order_status'
    ];

    // ความสัมพันธ์กับ OrdersDetails
    public function orderDetails()
    {
        return $this->hasMany(OrdersDetails::class, 'order_id', 'order_id');
    }
}
