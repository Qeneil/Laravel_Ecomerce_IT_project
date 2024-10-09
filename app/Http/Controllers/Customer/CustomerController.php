<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\Product; 


class CustomerController extends Controller
{
    public function shop() {
        
        return view('admin.layouts.shop');
    }
    public function contact() {
        return view('admin.layouts.contact');
    }

    public function mainshop(Request $request)
    {
        $productName = $request->input('product_name');
    $maxPrice = $request->input('price');

    $products = Product::when($productName, function ($query) use ($productName) {
        return $query->where('product_name', 'like', '%' . $productName . '%');
    })
    ->when($maxPrice, function ($query) use ($maxPrice) {
        return $query->where('price', '<=', $maxPrice);
    })
    ->get();

    $categories = Category::all();
    
        return view('user.mainshop', compact('products', 'categories'));
    }
    
    
}
