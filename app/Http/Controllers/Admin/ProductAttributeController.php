<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function index() {
        return view('admin.attribute.create');
    }

    public function manage() {
        return view('admin.attribute.manage');
    }
}
