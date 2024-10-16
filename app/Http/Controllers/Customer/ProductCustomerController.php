<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // นำเข้ารุ่น Product

class ProductCustomerController extends Controller
{
    public function ProductDetails($id) {
        // ดึงข้อมูลสินค้าตาม id
        $product = Product::findOrFail($id);
    
        // ดึงสินค้าที่เกี่ยวข้องในหมวดหมู่เดียวกัน
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('product_id', '!=', $id) // ไม่รวมสินค้าตัวเอง
            ->take(3) // จำกัดจำนวนที่จะแสดง
            ->get();
    
        // ส่งข้อมูลสินค้าและสินค้าที่เกี่ยวข้องไปยัง view
        return view('User.product.details', compact('product', 'relatedProducts'));
    }
    
    
}
