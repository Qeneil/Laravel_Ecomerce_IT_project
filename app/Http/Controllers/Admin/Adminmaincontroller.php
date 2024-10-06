<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class Adminmaincontroller extends Controller
{
    
    public function index() {
        return view('admin');
    }

    public function shop() {
        return view('admin.layouts.shop');
    }

    public function contact() {
        return view('admin.layouts.contact');
    }
   
    public function setting() {
        return view('admin.setting');
    }

   
    public function order() {
        return view('admin.order.history');
    }

   
    public function cart() {
        return view('admin.cart.history');
    }

    
    public function manage_users() {
        return view('admin.manage.user');
    }

   
    public function manage_sellers() {
        return view('admin.manage.sellers');
    }

    
    public function manage_store() {
        return view('admin.manage.store');
    }
}
