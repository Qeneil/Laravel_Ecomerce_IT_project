<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrdersDetails; // นำเข้า OrdersDetails Model

class CheckOutController extends Controller
{
    public function checkout() {
        // ดึงข้อมูลสินค้าที่อยู่ในตะกร้าจากฐานข้อมูลมาแสดงในหน้าชำระเงิน
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        // คำนวณยอดรวม
        $totalAmount = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        // ส่งข้อมูลไปยัง view
        return view('User.Check.chack', compact('cartItems', 'totalAmount'));
    }
    public function placeorder(Request $request) {
        // ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'กรุณาล็อกอินเพื่อทำการสั่งซื้อ');
        }
    
        // ตรวจสอบข้อมูลจากฟอร์ม
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);
    
        // ดึงข้อมูลสินค้าในตะกร้าของผู้ใช้
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
    
        // คำนวณยอดรวม
        $totalAmount = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
    
        // บันทึกข้อมูลคำสั่งซื้อในตาราง orders
        $order = new Order();
        $order->user_id = auth()->id(); // ระบุ user_id ที่ถูกต้อง
        $order->name = $request->input('name');
        $order->address = $request->input('address');
        $order->phone = $request->input('phone');
        $order->total_amount = $totalAmount;
        $order->save(); // บันทึกคำสั่งซื้อและดึง order_id ที่เพิ่งบันทึก
    
        // บันทึกรายละเอียดคำสั่งซื้อใน order_details โดยระบุ order_id ด้วยตัวเอง
        foreach ($cartItems as $item) {
            OrdersDetails::create([
                'order_id' => $order->id,  // กำหนดค่า order_id จากการบันทึก order
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }
    
        // ลบสินค้าทั้งหมดในตะกร้าหลังจากทำการสั่งซื้อ
        Cart::where('user_id', auth()->id())->delete();
    
        // redirect ไปยังหน้าขอบคุณ (Thank You page)
        return redirect()->route('showPaymentForm');
    }
    
    public function showPaymentForm() {
        return view('User.payment.payment'); // ต้องมีไฟล์ view นี้ในตำแหน่งที่ถูกต้อง
    }
    
    
}
