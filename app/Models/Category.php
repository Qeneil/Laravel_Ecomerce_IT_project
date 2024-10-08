<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name']; // ฟิลด์ที่อนุญาตให้ mass assignment

    // เพิ่มฟังก์ชันสำหรับความสัมพันธ์กับ Product
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
