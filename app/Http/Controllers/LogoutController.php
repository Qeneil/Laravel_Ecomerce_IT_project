<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
}
