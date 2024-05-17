<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name('login');
Route::post('/login', function () {
    return 'OK';
})->name('login');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'title' => 'Dashboard'
    ]);
})->name('dashboard');

Route::get('/master/barang', function() {
    return Inertia::render('Barang/Index', [
        'title' => 'Barang'
    ]);
})->name('barang');
Route::get('/master/customer', function() {
    return Inertia::render('Customer/Index', [
        'title' => 'Customer'
    ]);
})->name('customer');
Route::get('/transaksi/history', function() {
    return Inertia::render('Transaksi/Index', [
        'title' => 'History'
    ]);
})->name('transaksi.history');
Route::get('/transaksi/create', function() {
    return Inertia::render('Transaksi/Create', [
        'title' => 'Create'
    ]);
})->name('transaksi.create');
