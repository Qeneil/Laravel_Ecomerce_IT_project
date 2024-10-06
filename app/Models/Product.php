<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock_quantity',
        'category_id',
        'image',
    ];

    // เพิ่มฟังก์ชันสำหรับความสัมพันธ์กับ Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
