<?php

use Illuminate\Support\Facades\Route;
use Modules\Pengaduan\Http\Controllers\PengaduanController;

Route::middleware(['auth', 'role:officer,user'])->group(function () {
    Route::get('pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('pengaduan/data', [PengaduanController::class, 'getData'])->name('pengaduan.data');
    Route::post('pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('pengaduan/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('pengaduan/{pengaduan}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
});
