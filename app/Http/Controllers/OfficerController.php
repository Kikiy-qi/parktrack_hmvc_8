<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\SlotParkir\Models\ParkingSlot;

class OfficerController extends Controller
{
    public function index(): View
    {
        $totalSlots = ParkingSlot::count();
        $availableSlots = ParkingSlot::where('status', 'Tersedia')->count();
        $occupiedSlots = ParkingSlot::where('status', 'Terisi')->count();
        $reservedSlots = ParkingSlot::where('status', 'Booking')->count();

        $slotsSummary = [
            'available' => $availableSlots,
            'occupied' => $occupiedSlots,
            'reserved' => $reservedSlots,
        ];

        $occupiedByType = [
            'reguler' => ParkingSlot::where('status', 'Terisi')->where('tipe_kendaraan', 'Mobil')->count(),
            'vip' => ParkingSlot::where('status', 'Terisi')->where('tipe_kendaraan', 'Motor')->count(),
            'vvip' => 0,
        ];

        $reservedByType = [
            'reguler' => ParkingSlot::where('status', 'Booking')->where('tipe_kendaraan', 'Mobil')->count(),
            'vip' => ParkingSlot::where('status', 'Booking')->where('tipe_kendaraan', 'Motor')->count(),
            'vvip' => 0,
        ];

        $totalByType = [
            'reguler' => ParkingSlot::where('tipe_kendaraan', 'Mobil')->count(),
            'vip' => ParkingSlot::where('tipe_kendaraan', 'Motor')->count(),
            'vvip' => 0,
        ];

        $incomeReservations = (int) Reservation::sum('total_biaya');
        $incomePenalties = 75000;

        return view('officer.index', compact(
            'totalSlots',
            'slotsSummary',
            'occupiedByType',
            'reservedByType',
            'totalByType',
            'incomeReservations',
            'incomePenalties'
        ));
    }

    public function listParking(Request $request): View
    {
        $query = Reservation::with('parkingSlot')->latest();

        $search = $request->input('q', '');
        if (! empty($search)) {
            $query->where(function ($sub) use ($search) {
                $sub->where('plat_nomor', 'like', "%{$search}%")
                    ->orWhere('nama_pengemudi', 'like', "%{$search}%");
            });
        }

        $status = $request->input('status', 'all');
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $sort = $request->input('sort', 'newest');
        if ($sort === 'oldest') {
            $query->oldest();
        } elseif ($sort === 'status') {
            $query->orderBy('status', 'asc');
        }

        $reservations = $query->get();

        return view('officer.list_parking', compact('reservations', 'search', 'status', 'sort'));
    }

    public function checkUser(Request $request): View
    {
        $search = $request->input('q', '');

        $usersQuery = empty($search)
            ? User::where('role', UserRole::User)->get()
            : User::where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->get();

        $merged = collect();

        foreach ($usersQuery as $u) {
            $history = Reservation::where('nomor_telepon', $u->phone)->orWhere('nama_pengemudi', $u->name)->get();
            $merged->push([
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'phone' => $u->phone ?? '-',
                'wallet_balance' => 150000,
                'history' => $history,
                'has_active' => $history->where('status', 'Aktif')->isNotEmpty(),
            ]);
        }

        $users = $merged;

        return view('officer.check_user', compact('users', 'search'));
    }

    public function penalty(Request $request): View
    {
        $success = null;

        if ($request->isMethod('post')) {
            $success = 'Denda sebesar Rp '.number_format((int) $request->input('amount', 50000), 0, ',', '.').' untuk kendaraan '.strtoupper((string) $request->input('plate')).' berhasil dicatat.';
        }

        return view('officer.penalty', compact('success'));
    }

    public function reschedule(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'waktu_masuk' => ['required', 'date'],
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'waktu_masuk' => $request->input('waktu_masuk'),
        ]);

        return back()->with('success', 'Jadwal reservasi untuk plat '.$reservation->plat_nomor.' berhasil di-reschedule!');
    }
}

