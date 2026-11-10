<?php

namespace Modules\SlotParkir\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\SlotParkir\Http\Requests\SlotParkirRequest;
use Modules\SlotParkir\Models\ParkingSlot;

class SlotParkirController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();
        $status = $request->string('status')->trim()->toString();

        $slots = ParkingSlot::query()
            ->when($search !== '', function (Builder $query) use ($search) {
                $query->where(function (Builder $sub) use ($search) {
                    $sub->where('kode_slot', 'like', "%{$search}%")
                        ->orWhere('lantai', 'like', "%{$search}%")
                        ->orWhere('tipe_kendaraan', 'like', "%{$search}%");
                });
            })
            ->when($status !== '', fn (Builder $query) => $query->where('status', $status))
            ->orderBy('kode_slot')
            ->paginate(10)
            ->withQueryString();

        $summary = [
            'total' => ParkingSlot::count(),
            'tersedia' => ParkingSlot::where('status', 'Tersedia')->count(),
            'terisi' => ParkingSlot::where('status', 'Terisi')->count(),
            'booking' => ParkingSlot::where('status', 'Booking')->count(),
        ];

        return view('slotparkir::index', [
            'slots' => $slots,
            'search' => $search,
            'selectedStatus' => $status,
            'summary' => $summary,
        ]);
    }

    public function create(): View
    {
        return view('slotparkir::create');
    }

    public function store(SlotParkirRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['kode_slot'] = strtoupper($data['kode_slot']);

        ParkingSlot::create($data);

        return redirect()->route('slot-parkir.index')->with('success', 'Slot parkir baru berhasil ditambahkan.');
    }

    public function edit(ParkingSlot $slotParkir): View
    {
        return view('slotparkir::edit', ['slotParkir' => $slotParkir]);
    }

    public function update(SlotParkirRequest $request, ParkingSlot $slotParkir): RedirectResponse
    {
        $data = $request->validated();
        $data['kode_slot'] = strtoupper($data['kode_slot']);

        $slotParkir->update($data);

        return redirect()->route('slot-parkir.index')->with('success', 'Data slot parkir berhasil diperbarui.');
    }

    public function destroy(ParkingSlot $slotParkir): RedirectResponse
    {
        $slotParkir->delete();

        return redirect()->route('slot-parkir.index')->with('success', 'Data slot parkir berhasil dihapus.');
    }
}
