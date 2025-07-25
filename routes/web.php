<?php

use App\Http\Resources\UserResource;
use App\Livewire\Dashboard;
use App\Livewire\Penjual;
use App\Livewire\Pemesanan;
use App\Livewire\Produk;
use App\Livewire\RiwayatPemesanan;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', Dashboard::class)->name('dashboard');
Route::get('/penjual', Penjual::class)->name('penjual');
Route::get('/penjual/{id}', Penjual::class)->name('penjual.edit');
Route::get('/pemesanan', Pemesanan::class)->name('pemesanan');
Route::get('/riwayat-pemesanan', RiwayatPemesanan::class)->name('riwayat-pemesanan');
Route::get('/produk', Produk::class)->name('produk');
Route::get('/produk/{id}', Produk::class)->name('produk.edit');
