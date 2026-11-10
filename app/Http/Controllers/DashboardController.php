<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Pengaduan\Models\Pengaduan;
use Modules\SlotParkir\Models\ParkingSlot;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('dashboard', [
            'availableSlots' => ParkingSlot::where('status', 'Tersedia')->count(),
            'totalSlots' => ParkingSlot::count(),
            'totalPengaduan' => Pengaduan::count(),
            'totalReservasi' => Reservation::count(),
            'totalUsers' => $request->user()->isOfficer() ? User::count() : null,
        ]);
    }
}
