<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    // แสดงรายการผลิตภัณฑ์ทั้งหมด
    public function allproduct()
    {
        $products = Product::all(); // ดึงข้อมูลผลิตภัณฑ์ทั้งหมด
        return view('admin.product.allproduct', compact('products'));
    }

    // แสดงฟอร์มสำหรับสร้างผลิตภัณฑ์ใหม่
    public function create()
    {
        $categories = Category::all(); // ดึงข้อมูลหมวดหมู่ทั้งหมด
        return view('admin.product.addproduct', compact('categories')); // ส่งตัวแปรไปยัง view
    }

    // เก็บข้อมูลผลิตภัณฑ์ใหม่
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // กำหนด validation สำหรับภาพ
        ]);

        $imageName = time() . '.' . $request->image->extension(); // สร้างชื่อไฟล์ภาพที่ไม่ซ้ำ
        $request->image->move(public_path('admin-asset/images/Product'), $imageName); // ย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด

        Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'image' => 'admin-asset/images/Product/' . $imageName, // บันทึกที่อยู่ภาพในฐานข้อมูล
        ]);

        return redirect()->route('admin.product.allproduct')->with('success', 'Product added successfully!');
    }

    // แสดงฟอร์มสำหรับแก้ไขผลิตภัณฑ์
    public function edit($id)
    {
        $product = Product::findOrFail($id); // ค้นหาผลิตภัณฑ์ด้วย ID ที่ส่งมา
        return view('admin.product.edit', compact('product')); // ส่งข้อมูลไปยัง view แก้ไข
    }

    // อัปเดตข้อมูลผลิตภัณฑ์
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // กำหนด validation สำหรับภาพ
        ]);

        $product = Product::findOrFail($id); // ค้นหาผลิตภัณฑ์ด้วย ID ที่ส่งมา

        // อัปเดตข้อมูลผลิตภัณฑ์
        $product->product_name = $request->product_name;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            // ลบภาพเก่า (หากมี) ก่อนอัปโหลดภาพใหม่
            if (file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin-asset/images/Product'), $imageName);
            $product->image = 'admin-asset/images/Product/' . $imageName; // อัปเดตที่อยู่ภาพใหม่
        }

        $product->save(); // บันทึกการเปลี่ยนแปลงในฐานข้อมูล

        return redirect()->route('admin.product.allproduct')->with('success', 'Product updated successfully!');
    }

    // ลบผลิตภัณฑ์
    public function destroy($id)
    {
        $product = Product::findOrFail($id); // ค้นหาผลิตภัณฑ์ด้วย ID ที่ส่งมา

        // ลบภาพจากเซิร์ฟเวอร์ (หากมี)
        if (file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete(); // ลบผลิตภัณฑ์
        return redirect()->route('admin.product.allproduct')->with('success', 'Product deleted successfully!');
    }
}
