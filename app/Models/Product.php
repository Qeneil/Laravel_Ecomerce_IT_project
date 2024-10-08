<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // ระบุให้ Laravel รู้ว่าคีย์หลักคือ product_id
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock_quantity',
        'category_id', // ต้องมีอยู่แล้ว
        'image',
    ];

    // เพิ่มฟังก์ชันสำหรับความสัมพันธ์กับ Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
