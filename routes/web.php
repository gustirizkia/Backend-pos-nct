<?php

use App\Http\Controllers\Admin\AdminStoreController;
use App\Http\Controllers\Admin\MejaController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
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

Route::get('/', [DashboardController::class, 'index']);
Route::resource('produk', ProdukController::class);

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::resource("admin-store", AdminStoreController::class);
    Route::resource("store", StoreController::class);
    Route::resource("store-meja", MejaController::class);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
