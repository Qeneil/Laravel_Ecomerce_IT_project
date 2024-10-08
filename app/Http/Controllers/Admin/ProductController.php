<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; 
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // แสดงรายการผลิตภัณฑ์ทั้งหมด
    public function allProduct()
    {
        $products = Product::with('category')->get(); // ดึงข้อมูลผลิตภัณฑ์ทั้งหมด
        return view('admin.product.allproduct', compact('products')); // ส่งตัวแปร $products ไปยังมุมมอง
    }

    // ฟอร์มเพิ่มผลิตภัณฑ์
    public function create()
    {
        $categories = Category::all(); // ดึงข้อมูลหมวดหมู่ทั้งหมด
        return view('admin.product.addproduct', compact('categories'));
    }

    // บันทึกผลิตภัณฑ์ใหม่
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id', // ตรวจสอบ category_id
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // สร้างออบเจ็กต์ Product ใหม่
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        // การอัปโหลดภาพ
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin-asset/images/Product'), $imageName);
            $product->image = 'admin-asset/images/Product/' . $imageName;
        }

        // บันทึกสินค้าในฐานข้อมูล
        $product->save();

        // ส่งกลับไปยังหน้ารายการสินค้าพร้อมข้อความสำเร็จ
        return redirect()->route('admin.product.allproduct')->with('success', 'Product added successfully.');
    }
    
    // แก้ไขผลิตภัณฑ์
    public function edit($product_id)
    {
        // ค้นหาผลิตภัณฑ์โดยใช้ product_id
        $product = Product::findOrFail($product_id);
        $categories = Category::all(); // ดึงข้อมูลหมวดหมู่ทั้งหมด
        return view('admin.product.editproduct', compact('product', 'categories'));
    }

    // อัปเดตผลิตภัณฑ์
    public function update(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        // Validate input
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update product attributes
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $product->description = $request->description;

        // Handle category id
        if ($request->filled('category_id')) {
            $product->category_id = $request->category_id;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin-asset/images/Product'), $imageName);
            $product->image = 'admin-asset/images/Product/' . $imageName;
        }

        // Save product
        $product->save();

        return redirect()->route('admin.product.allproduct')->with('success', 'Product updated successfully.');
    }

    // ลบผลิตภัณฑ์
    public function destroy($product_id)
    {
        $product = Product::findOrFail($product_id);
        
        // Delete image from storage
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        // Delete the product
        $product->delete();

        return redirect()->route('admin.product.allproduct')->with('success', 'Product deleted successfully.');
    }
}
