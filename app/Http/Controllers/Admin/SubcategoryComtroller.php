<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubcategoryComtroller extends Controller
{
    public function index() {
        return view('admin.subcategory.createsub');
    }
    public function manage_subcat() {
        return view('admin.subcategory.managesub');
    }
}
