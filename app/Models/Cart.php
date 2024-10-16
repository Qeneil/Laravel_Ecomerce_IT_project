<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts'; // ชื่อของตารางในฐานข้อมูล

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    // กำหนดความสัมพันธ์กับโมเดล Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // กำหนดความสัมพันธ์กับโมเดล User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
