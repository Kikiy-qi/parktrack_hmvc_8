<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\ReservationController;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('info', fn () => view('pages.info'))->name('info');
    Route::get('denda', fn () => view('pages.denda'))->name('denda');
    Route::get('reservasi', [ReservationController::class, 'index'])->name('reservasi.form');
    Route::post('reservasi/proses', [ReservationController::class, 'proses'])->name('reservasi.proses');
    Route::get('pembayaran', fn () => view('pages.pembayaran'))->name('pembayaran');
    Route::get('status', function () {
        $reservations = Reservation::with('parkingSlot')->latest()->get();

        return view('pages.status', compact('reservations'));
    })->name('status');

    Route::get('data-parkir', function () {
        if (auth()->user()->isOfficer()) {
            return redirect()->route('officer.list_parking');
        }

        return redirect()->route('slot-parkir.index');
    })->name('data-parkir');

    Route::middleware('role:officer')->prefix('officer')->group(function () {
        Route::get('/', [OfficerController::class, 'index'])->name('officer.index');
        Route::get('/list_parking', [OfficerController::class, 'listParking'])->name('officer.list_parking');
        Route::put('/list_parking/{id}/reschedule', [OfficerController::class, 'reschedule'])->name('officer.parking.reschedule');
        Route::get('/check_user', [OfficerController::class, 'checkUser'])->name('officer.check_user');
        Route::match(['get', 'post'], '/penalty', [OfficerController::class, 'penalty'])->name('officer.penalty');
    });
});
