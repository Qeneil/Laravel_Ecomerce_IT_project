<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Order; // นำเข้าคลาส Order
use App\Models\OrdersDetails; // นำเข้าคลาส OrdersDetails
class PaymentController extends Controller
{
    public function checkpayment()
    {
        // ดึงข้อมูลคำสั่งซื้อของผู้ใช้พร้อมรายละเอียดสินค้า
        $orders = Order::with('orderDetails.product')->where('user_id', auth()->id())->get();
    
        return view('User.payment.checkpayment', compact('orders'));
    }

    public function payments(Request $request)
    {
        // ตั้งค่า Stripe secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // ตรวจสอบว่ามีการส่ง Stripe token มาหรือไม่
        $token = $request->input('stripeToken');

        try {
            // สร้าง Charge
            $charge = Charge::create([
                'amount' => 2000, // ยอดเงินเป็นเซ็นต์ เช่น $20.00 = 2000 เซ็นต์
                'currency' => 'thb',
                'description' => 'Payment for Order',
                'source' => $token,
            ]);

            // แสดงผลสำเร็จ
            return redirect()->route('checkpayment')->with('success', 'Payment successful!');

        } catch (\Exception $e) {
            // แสดงผลหากเกิดข้อผิดพลาด
            return back()->with('error', $e->getMessage());
        }
    }
}