<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrdersDetails; // นำเข้า OrdersDetails Model
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    
        // ตรวจสอบว่าตะกร้ามีสินค้าหรือไม่
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'ตะกร้าสินค้าของคุณว่างเปล่า');
        }
    
        // คำนวณยอดรวม
        $totalAmount = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
    
        // เริ่มต้นการทำธุรกรรม
        DB::beginTransaction();
    
        try {
            // บันทึกข้อมูลคำสั่งซื้อในตาราง orders
            $order = new Order();
            $order->user_id = auth()->id();
            $order->name = $request->input('name');
            $order->address = $request->input('address');
            $order->phone = $request->input('phone');
            $order->total_amount = $totalAmount;
    
            // บันทึกคำสั่งซื้อ
            if ($order->save()) {
                // บันทึกรายละเอียดคำสั่งซื้อใน order_details
                foreach ($cartItems as $item) {
                    OrdersDetails::create([
                        'order_id' => $order->order_id, // กำหนดค่า order_id จากการบันทึก order
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                    ]);
                }
    
                // ลบสินค้าทั้งหมดในตะกร้าหลังจากทำการสั่งซื้อ
                Cart::where('user_id', auth()->id())->delete();
    
                // ยืนยันการทำธุรกรรม
                DB::commit();
    
                // redirect ไปยังหน้าขอบคุณ (Thank You page)
                return redirect()->route('showPaymentForm')->with('success', 'คำสั่งซื้อของคุณได้ถูกบันทึกเรียบร้อยแล้ว');
            } else {
                throw new \Exception('ไม่สามารถบันทึกคำสั่งซื้อได้');
            }
        } catch (\Exception $e) {
            // ยกเลิกการทำธุรกรรมหากเกิดข้อผิดพลาด
            DB::rollBack();
            Log::error('Error occurred: ' . $e->getMessage());
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกคำสั่งซื้อ: ' . $e->getMessage());
        }
    }
    
    
    public function showPaymentForm() {
        return view('User.payment.payment'); // ต้องมีไฟล์ view นี้ในตำแหน่งที่ถูกต้อง
    }
    
    
}
