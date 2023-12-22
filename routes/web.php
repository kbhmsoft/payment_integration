<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginRegisterController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [LoginRegisterController::class, 'login']);
 
Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/payment/form', [PaymentController::class, 'createPayment'])->name('payment.form');
    Route::get('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/success', [PaymentController::class, 'successPayment'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancelPayment'])->name('payment.cancel');
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    Route::get('/product', function () {
        return view('product');
    })->name('product');
    Route::get('/payment/result', function () {
        return view('payment.result');
    })->name('result');
});
