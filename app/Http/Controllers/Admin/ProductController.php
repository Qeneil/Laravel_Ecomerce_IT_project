<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function create() {
        $categories = Category::all(); // ดึงข้อมูลหมวดหมู่จากฐานข้อมูล
        return view('admin.product.addproduct', compact('categories')); // ส่งข้อมูลหมวดหมู่ไปยัง view
    }
  
    public function allproduct() {
        $products = Product::with('category')->get(); // ดึงผลิตภัณฑ์ทั้งหมด พร้อมข้อมูล category
        Log::info($products); // log ข้อมูลเพื่อตรวจสอบ
        return view('admin.product.allproduct', compact('products')); // ส่งข้อมูลผลิตภัณฑ์ไปยัง view
    }
    
    public function store(Request $request) {
        $request->validate([
            'productName' => 'required|string|max:100',
            'productPrice' => 'required|numeric',
            'productQuantity' => 'required|integer',
            'productShortDesc' => 'required|string',
            'productLongDesc' => 'required|string',
            'category' => 'required|exists:categories,id',
            'productImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the uploaded image
        $imagePath = null; 
        if ($request->hasFile('productImage')) {
            // Save the image to public storage
            $imagePath = $request->file('productImage')->store('images/Product', 'public');
        }

        // Create the product
        Product::create([
            'product_name' => $request->productName,
            'description' => $request->productLongDesc,
            'price' => $request->productPrice,
            'stock_quantity' => $request->productQuantity,
            'category_id' => $request->category, 
            'image' => $imagePath, 
        ]);

        return redirect()->route('admin.product.allproduct')->with('success', 'Product added successfully!');
    }

    public function edit($id) {
        $product = Product::with('category')->findOrFail($id); 
        $categories = Category::all(); 
        return view('admin.product.editproduct', compact('product', 'categories')); 
    }

    public function update(Request $request, $id) {
        $request->validate([
            'productName' => 'required|string|max:100',
            'productPrice' => 'required|numeric',
            'productQuantity' => 'required|integer',
            'productShortDesc' => 'required|string',
            'productLongDesc' => 'required|string',
            'category' => 'required|exists:categories,id', 
            'productImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('productImage')) {
            // Save the new image to public storage
            $imagePath = $request->file('productImage')->store('images/Product', 'public');
            $product->image = $imagePath; 
        }

        $product->update([
            'product_name' => $request->productName,
            'description' => $request->productLongDesc,
            'price' => $request->productPrice,
            'stock_quantity' => $request->productQuantity,
            'category_id' => $request->category, 
        ]);

        return redirect()->route('admin.product.allproduct')->with('success', 'Product updated successfully!');
    }

    public function destroy($id) {
        $product = Product::findOrFail($id); 

        if ($product->image) {
            // Delete the image from storage
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete(); 

        return redirect()->route('admin.product.allproduct')->with('success', 'Product deleted successfully!');
    }
}
