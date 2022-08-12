<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',['App\Http\Controllers\InvoiceController'::class,'index']);
Route::post("create",['App\Http\Controllers\InvoiceController'::class,'create']);
Route::get("/edit/{id}",['App\Http\Controllers\InvoiceController'::class, 'edit']);
Route::put("/update/{id}",['App\Http\Controllers\InvoiceController'::class, 'update']);
Route::get("/delete/{id}",['App\Http\Controllers\InvoiceController'::class, 'delete']);
Route::get("/paid/{id}",['App\Http\Controllers\InvoiceController'::class, 'paid']);
Route::get("/view/{id}",['App\Http\Controllers\InvoiceController'::class, 'view']);
Route::get("/delete_item/{id}",['App\Http\Controllers\InvoiceController'::class, 'delete_item']);