<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
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

Route::get('/', [InvoiceController::class, 'index']);
Route::post("create",[InvoiceController::class,'create']);
Route::get("/edit/{id}",[InvoiceController::class, 'edit']);
Route::put("/update/{id}",[InvoiceController::class, 'update']);
Route::get("/delete/{id}",[InvoiceController::class, 'delete']);
Route::get("/paid/{id}",[InvoiceController::class, 'paid'])->name('paid');
Route::get("/view/{id}",[InvoiceController::class, 'view']);
Route::get("/delete_item/{id}",[InvoiceController::class, 'delete_item']);
