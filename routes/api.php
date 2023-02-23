<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('cekLogin', [AuthController::class, 'cekLogin'])->middleware('auth:sanctum');

// produk
Route::resource('produk', ProdukController::class);
Route::resource('cart', CartController::class);
