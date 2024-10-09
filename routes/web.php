<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Rolemanager;
use App\Http\Controllers\Admin\Adminmaincontroller;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController; 
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Admin\ProductPaymentController;
use App\Http\Controllers\Customer\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'rolemanager:customer'])->name('dashboard');

// Shop route
Route::get('/shop', [CustomerController::class, 'shop'])->name('shop');

// Contact route
Route::get('/contact', [CustomerController::class, 'contact'])->name('contact');

Route::get('/mainshop', [CustomerController::class, 'mainshop'])->name('mainshop');


// Admin Routes
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(Adminmaincontroller::class)->group(function () {
            Route::get('/dashboard', 'index')->name('admin');
            Route::get('/setting', 'setting')->name('admin.setting');
            Route::get('/order/history', 'order')->name('admin.order.history');
            Route::get('/cart/history', 'cart')->name('admin.cart.history');
            Route::get('/manage/users', 'manage_users')->name('admin.manage.users');
            Route::get('/manage/sellers', 'manage_sellers')->name('admin.manage.sellers');
            Route::get('/manage/store', 'manage_store')->name('admin.manage.store');
        });

        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category/create', 'index')->name('admin.category.create');
            Route::get('/admin/category/manage/{id}', 'manage_category')->name('admin.category.manage');
            Route::get('/category/edit/{id}', 'edit')->name('admin.category.edit'); 
            Route::put('/category/update/{id}', 'update')->name('admin.category.update');
            Route::post('/category/store', 'store')->name('admin.category.store');
            Route::get('/allcategory', 'allcategory')->name('admin.category.allcategory'); 
            Route::delete('/category/destroy/{id}', 'destroy')->name('admin.category.destroy'); 
        });

        Route::controller(SubcategoryController::class)->group(function () {
            Route::get('/subcategory/create', 'index')->name('admin.subcategory.createsub');
            Route::get('/subcategory/manage', 'manage_subcat')->name('admin.subcategory.managesub');
            Route::delete('/subcategory/destroy/{id}', 'destroy')->name('admin.subcategory.destroy'); // เพิ่ม route นี้
        });
        Route::controller(ProductController::class)->group(function () {
            Route::get('/product/create', 'create')->name('admin.product.addproduct');
            Route::post('/product/store', 'store')->name('admin.product.store');
            Route::get('/product/allproduct', 'allProduct')->name('admin.product.allproduct');
            Route::delete('/product/{id}', 'destroy')->name('admin.product.destroy'); 
            Route::put('/product/update/{id}', 'update')->name('admin.product.update');
            Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        });
        

        Route::controller(ProductAttributeController::class)->group(function () {
            Route::get('/attribute/create', 'index')->name('admin.attribute.create');
            Route::get('/attribute/manage', 'manage')->name('admin.product.manage');
        });

        Route::controller(ProductDiscountController::class)->group(function () {
            Route::get('/discount/create', 'index')->name('admin.discount.create');
            Route::get('/discount/manage', 'manage')->name('admin.discount.manage');
        });

        Route::controller(ProductPaymentController::class)->group(function () {
            Route::get('/payment/create', 'index')->name('admin.payment.create');
            Route::get('/payment/manage', 'manage')->name('admin.payment.manage');
        });
    });
});

// Vendor Routes
Route::get('/vendor/dashboard', function () {
    return view('vendor');
})->middleware(['auth', 'verified', 'rolemanager:vendor'])->name('vendor');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

require __DIR__ . '/auth.php';
