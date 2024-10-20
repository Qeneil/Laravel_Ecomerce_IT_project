<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // ตั้งชื่อของตาราง
    protected $primaryKey = 'product_id'; // กำหนด primary key
    public $timestamps = true; // ถ้าคุณใช้ timestamps ให้ตั้งค่าเป็น true

    protected $fillable = [
        'product_name', 'description', 'price', 'stock_quantity', 'category_id', 'image',
    ];

    // ความสัมพันธ์กับ Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // ความสัมพันธ์กับ OrdersDetails
    public function ordersDetails()
    {
        return $this->hasMany(OrdersDetails::class, 'product_id', 'product_id');
    }
}


