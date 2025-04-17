<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscountRuleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/discount-rules',[DiscountRuleController::class,'index'])->name('discount-rules.index');
Route::get('/discount-rules/create',[DiscountRuleController::class,'create'])->name('discount-rules.create');
Route::post('/discount-rules',[DiscountRuleController::class,'store'])->name('discount-rules.store');
Route::get('/discount-rules/{discountRule}/edit',[DiscountRuleController::class,'edit'])->name('discount-rules.edit');
Route::put('/discount-rules/{discountRule}',[DiscountRuleController::class,'update'])->name('discount-rules.update');
Route::delete('/discount-rules/{discountRule}',[DiscountRuleController::class,'destroy'])->name('discount-rules.destroy');

Route::get('/apply-discount-form',[DiscountRuleController::class,'applyDiscountForm'])->name('discount-rules.apply-form');
Route::Post('/apply-discount-form',[DiscountRuleController::class,'applyDiscount'])->name('discount-rules.apply');