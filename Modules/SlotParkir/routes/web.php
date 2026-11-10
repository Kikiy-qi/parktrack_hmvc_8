<?php

use Illuminate\Support\Facades\Route;
use Modules\SlotParkir\Http\Controllers\SlotParkirController;

Route::middleware(['auth', 'role:officer,user'])->group(function () {
    Route::get('slot-parkir', [SlotParkirController::class, 'index'])->name('slot-parkir.index');
});

Route::middleware(['auth', 'role:officer'])->group(function () {
    Route::get('slot-parkir/create', [SlotParkirController::class, 'create'])->name('slot-parkir.create');
    Route::post('slot-parkir', [SlotParkirController::class, 'store'])->name('slot-parkir.store');
    Route::get('slot-parkir/{slotParkir}/edit', [SlotParkirController::class, 'edit'])->name('slot-parkir.edit');
    Route::put('slot-parkir/{slotParkir}', [SlotParkirController::class, 'update'])->name('slot-parkir.update');
    Route::delete('slot-parkir/{slotParkir}', [SlotParkirController::class, 'destroy'])->name('slot-parkir.destroy');
});
    