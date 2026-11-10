<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\SlotParkir\Models\ParkingSlot;

class ReservationController extends Controller
{
    public function index(): View
    {
        $slots = ParkingSlot::orderBy('kode_slot')->get();
        $available_slots = ParkingSlot::where('status', 'Tersedia')->count();

        return view('pages.reservasi', compact('slots', 'available_slots'));
    }

    public function proses(Request $request): RedirectResponse
    {
        $slotId = $request->input('slot_id') ?? $request->input('parking_slot_id') ?? ParkingSlot::first()?->id;
        $nama = $request->input('name') ?? $request->input('driver_name') ?? $request->user()?->name ?? 'Pengemudi';
        $phone = $request->input('phone') ?? $request->user()?->phone ?? '-';
        $plate = strtoupper($request->input('plate') ?? $request->input('plate_number') ?? 'B 1234 XX');
        $vehicleType = $request->input('vehicle_type') ?? 'Mobil';
        $paymentMethod = $request->input('payment_method') ?? 'QRIS';
        $totalBiaya = $request->input('total_biaya') ?? 4000;

        Reservation::create([
            'parking_slot_id' => $slotId,
            'nama_pengemudi' => $nama,
            'nomor_telepon' => $phone,
            'plat_nomor' => $plate,
            'jenis_kendaraan' => ucfirst($vehicleType),
            'metode_pembayaran' => $paymentMethod,
            'total_biaya' => (int) $totalBiaya,
            'status' => 'Aktif',
            'waktu_masuk' => $request->input('expected_entry_time') ?: now(),
        ]);

        if ($slotId) {
            ParkingSlot::where('id', $slotId)->update(['status' => 'Booking']);
        }

        return redirect()->route('status')->with('success', 'Reservasi parkir berhasil disimpan!');
    }
}

