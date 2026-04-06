<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RajaOngkirController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/checkout/token', [CheckoutController::class, 'getSnapToken'])->name('checkout.token');
Route::post('/checkout', [CheckoutController::class, 'toCheckout'])->name('checkout');

Route::post('/checkout/update', [CheckoutController::class, 'updateStatus'])->name('checkout.updateStatus');
// Midtrans webhook (use /api/midtrans/notification for external webhook calls)
Route::post('/midtrans/notification', [App\Http\Controllers\MidtransController::class, 'handleNotification'])->name('api.midtrans.notification');