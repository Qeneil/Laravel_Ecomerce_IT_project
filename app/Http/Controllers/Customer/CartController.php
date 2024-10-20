<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function cart() {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
    
        // ดีบักข้อมูลที่ดึงมา
        \Log::info($cartItems);
    
        return view('User.cart.cart', compact('cartItems'));
    }
    
    
    
    public function addToCart(Request $request, $product_id)
{
    $product = Product::find($product_id);
    if (!$product) {
        return redirect()->back()->with('error', 'Product not found');
    }

    $cartItem = Cart::where('user_id', auth()->id())
                    ->where('product_id', $product_id)
                    ->first();

    if ($cartItem) {
        // เพิ่มจำนวนสินค้าในตะกร้า
        $cartItem->quantity += $request->input('quantity', 1);
        $cartItem->save();
    } else {
        // สร้างรายการใหม่ในตะกร้า
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $product_id,
            'quantity' => $request->input('quantity', 1),
        ]);
    }

    return redirect()->route('cart')->with('success', 'Product added to cart successfully');
}
public function removeItemById($id) {
    $cartItem = Cart::where('user_id', auth()->id())
                    ->where('id', $id) // ลบตาม id ของตาราง carts
                    ->first();
    
    if ($cartItem) {
        $cartItem->delete();
        return redirect()->route('cart')->with('success', 'Delete product in cart successfully');
    }

    return redirect()->route('cart')->with('error', 'Product not found in cart');
}
public function removeAll() {
    Cart::where('user_id', auth()->id())->delete();

    return redirect()->route('cart')->with('success', 'Remove all products in cart successfully');
}
}
