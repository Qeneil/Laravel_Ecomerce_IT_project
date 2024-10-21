<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // แสดงรายการคำสั่งซื้อที่รอการอนุมัติ
    public function showApproveOrder()
    {
        $orders = Order::with('orderDetails.product') // ดึงข้อมูล orderDetails และ Product
                        ->where('order_status', 'Pending')
                        ->get(); // ดึงคำสั่งซื้อที่รออนุมัติ

        return view('admin.order.apoveorder', compact('orders'));
    }

    // อนุมัติคำสั่งซื้อ
    public function approveOrder($orderId)
    {
        $order = Order::where('order_id', $orderId)->first(); // ค้นหาโดย order_id
    
        if ($order) {
            $order->order_status = 'Paid'; // เปลี่ยนสถานะ
            $order->save();
    
            return redirect()->back()->with('success', 'Order approved successfully!');
        }
    
        return redirect()->back()->withErrors('Order not found.');
    }
    


    // ฟังก์ชันอื่นๆ เช่น manage
    public function manage()
    {
        // จัดการการชำระเงินที่นี่
    }
   
    
    
}

