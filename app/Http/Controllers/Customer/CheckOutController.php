<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrdersDetails; // เปลี่ยนเป็นชื่อโมเดลที่ถูกต้อง
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckOutController extends Controller
{
    // ฟังก์ชันสำหรับหน้า Checkout
    public function checkout(Request $request) {
        // ดึงข้อมูลสินค้าที่อยู่ในตะกร้าจากฐานข้อมูลมาแสดงในหน้าชำระเงิน
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
    
        // ตรวจสอบว่า $checkoutData ถูกส่งมาหรือไม่
        $checkoutData = session('checkoutData');
    
        // คำนวณยอดรวมถ้ามีตะกร้า
        $totalAmount = 0;
        if ($cartItems->isNotEmpty()) {
            $totalAmount = $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });
        } elseif ($checkoutData) {
            // หากมีข้อมูลจาก Buy Now ให้ใช้ข้อมูลนั้น
            $totalAmount = $checkoutData['total'];
        }
    
        // ส่งข้อมูลไปยัง view
        return view('User.Check.chack', compact('cartItems', 'totalAmount', 'checkoutData'));
    }
    
    public function checkNow() {
        // ตรวจสอบว่า $checkoutData ถูกส่งมาหรือไม่
        $checkoutData = session('checkoutData');
    
        // ถ้าไม่มีข้อมูลใน session ให้ redirect กลับ
        if (!$checkoutData) {
            return redirect()->route('mainshop')->with('error', 'ไม่มีข้อมูลการสั่งซื้อ');
        }
    
        // คำนวณยอดรวม
        $totalAmount = $checkoutData['price'] * $checkoutData['quantity'];
    
        // ส่งข้อมูลไปยัง view
        return view('User.Check.checknow', compact('checkoutData', 'totalAmount'));
    }
    
    // ฟังก์ชันสำหรับการสั่งซื้อ
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
                    OrdersDetails::create([ // ใช้ชื่อโมเดลที่ถูกต้อง
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
    
    // ฟังก์ชันสำหรับการแสดงหน้าชำระเงิน
    public function showPaymentForm() {
        return view('User.payment.payment'); // ต้องมีไฟล์ view นี้ในตำแหน่งที่ถูกต้อง
    }

    // ฟังก์ชันสำหรับการสั่งซื้อโดยตรงจากปุ่ม Buy Now
   // ฟังก์ชันสำหรับการสั่งซื้อโดยตรงจากปุ่ม Buy Now
   public function placeOrderNow(Request $request)
   {
       // ตรวจสอบว่ามีข้อมูลใน session หรือไม่
       if (!session()->has('checkoutData')) {
           return redirect()->route('mainshop')->with('error', 'ไม่มีข้อมูลในการสั่งซื้อ');
       }
   
       // ตรวจสอบข้อมูลจากฟอร์ม
       $validatedData = $request->validate([
           'name' => 'required|string|max:255',
           'address' => 'required|string|max:255',
           'phone' => 'required|string|max:20',
       ]);
   
       $checkoutData = session('checkoutData');
   
       // ตรวจสอบว่า product_id มีอยู่ใน $checkoutData
       if (!isset($checkoutData['product_id'])) {
           return redirect()->back()->with('error', 'ไม่พบข้อมูลสินค้าในการสั่งซื้อ');
       }
   
       // สร้างคำสั่งซื้อ
       $order = Order::create([
           'user_id' => auth()->id(),
           'total_amount' => $checkoutData['total'],
           'name' => $validatedData['name'],
           'address' => $validatedData['address'],
           'phone' => $validatedData['phone'],
       ]);
   
       // สร้างรายละเอียดคำสั่งซื้อ
       OrdersDetails::create([
           'order_id' => $order->order_id,
           'product_id' => $checkoutData['product_id'], // ใช้ product_id ที่ถูกต้อง
           'quantity' => $checkoutData['quantity'],
           'price' => $checkoutData['price'],
       ]);
   
       // ล้างข้อมูลใน session หลังจากสั่งซื้อเสร็จสิ้น
       session()->forget('checkoutData');
   
       // เปลี่ยนเส้นทางไปยังหน้าการยืนยันการสั่งซื้อ
       return redirect()->route('showPaymentForm', ['order' => $order->order_id]);
   }
   


    // ฟังก์ชัน Buy Now
    // ฟังก์ชัน Buy Now
// ฟังก์ชัน Buy Now
public function buyNow(Request $request, $id)
{
    $product = Product::find($id);
    $quantity = $request->input('quantity', 1);

    // เก็บข้อมูลสินค้าและจำนวนใน session
    $checkoutData = [
        'product_name' => $product->product_name,
        'price' => $product->price,
        'quantity' => $quantity,
        'total' => $product->price * $quantity,
        'product_id' => $product->product_id // เพิ่ม product_id
    ];
    
    session(['checkoutData' => $checkoutData]);

    // เปลี่ยนเส้นทางไปที่หน้า checknow
    return redirect()->route('checknow');
}

}
