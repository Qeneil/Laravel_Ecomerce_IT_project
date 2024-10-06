<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function shop() {
        return view('admin.layouts.shop');
    }
    public function contact() {
        return view('admin.layouts.contact');
    }
}
