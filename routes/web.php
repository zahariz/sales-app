<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => ['guest']], function (){
    Route::get('/login',[AuthController::class, 'login'])->name('login');
    Route::post('/login',[AuthController::class, 'authenticate'])->name('login.auth');
});

Route::group(['middleware' => ['auth']], function(){
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', function(){
        return Inertia::render('Profile/Index', [
            'title' => 'Profile'
        ]);
    })->name('profile');

    Route::get('/dashboard',[HomeController::class, 'index'])->name('dashboard');

    Route::get('/master/barang', [ProductController::class, 'index'])->name('barang');
    Route::get('/master/barang/create', [ProductController::class, 'create'])->name('barang.create');
    Route::post('/master/barang/store', [ProductController::class, 'store'])->name('barang.store');
    Route::get('/master/barang/{id}/edit', [ProductController::class, 'edit'])->name('barang.edit')->where('id', '[0-9]+');
    Route::put('/master/barang/{id}/update', [ProductController::class, 'update'])->name('barang.update')->where('id', '[0-9]+');
    Route::delete('/master/barang/{id}/delete', [ProductController::class, 'delete'])->name('barang.destroy')->where('id', '[0-9]+');

    Route::get('/master/customer', [CustomerController::class, 'index'])->name('customer');
    Route::get('/master/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/master/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/master/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit')->where('id', '[0-9]+');
    Route::put('/master/customer/{id}/update', [CustomerController::class, 'update'])->name('customer.update')->where('id', '[0-9]+');
    Route::delete('/master/customer/{id}/destroy', [CustomerController::class, 'destroy'])->name('customer.destroy')->where('id', '[0-9]+');



    Route::get('/transaksi/history', [TransactionController::class, 'index'])->name('transaksi.history');

    Route::get('/transaksi/create', [TransactionController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/store', [TransactionController::class, 'store'])->name('transaksi.store');

});

