<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // นำเข้าโมเดล Category

class CategoryController extends Controller
{
    public function index() {
        return view('admin.category.create');
    }

    public function manage_category($id) {
        $category = Category::findOrFail($id); // ดึงข้อมูลหมวดหมู่ตาม ID
        return view('admin.category.manage', compact('category')); // ส่งข้อมูลหมวดหมู่ไปยังวิว
    }

    public function allcategory() {
        $categories = Category::all(); // ดึงข้อมูลทั้งหมดจากหมวดหมู่
        return view('admin.category.allcategory', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'category_name' => 'required|string|max:50',
        ]);

        Category::create([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('admin.category.allcategory')->with('success', 'Category added successfully!');
    }

    public function edit($id) {
        $category = Category::findOrFail($id); // ดึงข้อมูลหมวดหมู่ตาม ID
        return view('admin.category.edit', compact('category')); // ส่งข้อมูลไปยังฟอร์มแก้ไข
    }

    public function update(Request $request, $id) {
        $request->validate([
            'category_name' => 'required|string|max:50',
        ]);
    
        $category = Category::findOrFail($id); // ดึงข้อมูลหมวดหมู่ตาม ID
        $category->update([
            'category_name' => $request->category_name,
        ]);
    
        return redirect()->route('admin.category.allcategory')->with('success', 'Category updated successfully!'); // ส่งกลับไปยังหน้ารายการหมวดหมู่
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id); // ใช้ findOrFail แทน find

        $category->delete();
        return redirect()->route('admin.category.allcategory')->with('success', 'Category deleted successfully.');
    }
}
