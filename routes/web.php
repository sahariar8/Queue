<?php

use App\Http\Controllers\MoneyTransferController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/registration',[RegistrationController::class,'index'])->name('reg');
Route::post('/registration',[RegistrationController::class,'store'])->name('store');
Route::get('/send-otp',[RegistrationController::class,'sendOtp'])->name('send-otp');
Route::get('/money-transfer', [MoneyTransferController::class,'index'])->name('money-transfer');
Route::post('/money-transfer', [MoneyTransferController::class,'store'])->name('money-transfer.store');
