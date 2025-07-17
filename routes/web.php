<?php

use App\Http\Resources\UserResource;
use App\Livewire\Dashboard;
use App\Livewire\Penjual;
use App\Livewire\Pemesanan;
use App\Livewire\Produk;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/user', function () {
    return new UserResource(User::all());
});

Route::get('/penjual', Penjual::class)->name('penjual');
Route::get('/penjual/{id}', Penjual::class)->name('penjual.edit');
Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/pemesanan', Pemesanan::class)->name('pemesanan');
Route::get('/produk', Produk::class)->name('produk');
Route::get('/produk/{id}', Produk::class)->name('produk.edit');