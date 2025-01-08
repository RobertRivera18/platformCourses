<?php

use App\Models\Lesson;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use CodersFree\Shoppingcart\Facades\Cart;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CheckoutController;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

Route::get('/', [WelcomeController::class, 'index']);
Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::get('cart/pay', [CartController::class, 'pay'])->name('pay');
Route::get('courses-status/{course}', [CourseController::class, 'status'])->name('courses.status');
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('checkout/createPaypalOrder', [CheckoutController::class, 'createPaypalOrder'])->name('checkout.createPaypalOrder');
Route::post('checkout/capturePaypalOrder', [CheckoutController::class, 'capturePaypalOrder'])->name('checkout.capturePaypalOrder');
Route::get('gracias', function () {
   return 'Gracias por la compra';})->name('gracias');

Route::get('prueba', function () {
   dd(auth()->user()->courses_enrolled->contains(25));
});
