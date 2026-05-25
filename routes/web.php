<?php

use App\Http\Controllers\AsesmenController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('kunjungan.index'));

// Pasien & Kunjungan
Route::resource('kunjungan', KunjunganController::class)->except(['show']);
Route::get('/pasien/{pasien}/kunjungan/tambah', [KunjunganController::class, 'addKunjungan'])->name('kunjungan.add');
Route::post('/pasien/{pasien}/kunjungan/tambah', [KunjunganController::class, 'storeKunjungan'])->name('kunjungan.store-new');

// Asesmen
Route::get('/kunjungan/{kunjungan}/asesmen/buat', [AsesmenController::class, 'create'])->name('asesmen.create');
Route::post('/kunjungan/{kunjungan}/asesmen', [AsesmenController::class, 'store'])->name('asesmen.store');
Route::get('/kunjungan/{kunjungan}/asesmen/edit', [AsesmenController::class, 'edit'])->name('asesmen.edit');
Route::put('/kunjungan/{kunjungan}/asesmen', [AsesmenController::class, 'update'])->name('asesmen.update');
Route::get('/pasien/{pasien}/riwayat-asesmen', [AsesmenController::class, 'riwayat'])->name('asesmen.riwayat');

// Laporan
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
