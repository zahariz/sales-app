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

Route::get('/profile', function(){
    return Inertia::render('Profile/Index', [
        'title' => 'Profile'
    ]);
})->name('profile');

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
Route::get('/master/barang/create', function() {
    return Inertia::render('Barang/Create', [
        'title' => 'Barang'
    ]);
})->name('barang.create');
Route::get('/master/barang/create', function() {
    return Inertia::render('Barang/Create', [
        'title' => 'Barang'
    ]);
})->name('barang.create');
Route::post('/master/barang/store', function() {
    return 'sip';
})->name('barang.store');


Route::get('/master/customer', function() {
    return Inertia::render('Customer/Index', [
        'title' => 'Customer'
    ]);
})->name('customer');
Route::get('/master/customer/create', function() {
    return Inertia::render('Customer/Create', [
        'title' => 'Customer'
    ]);
})->name('customer.create');
Route::post('/master/customer/store', function() {
    return 'sip';
})->name('customer.store');



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
