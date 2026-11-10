@extends('layouts.app')

@section('title', 'Manajemen Slot Parkir - ParkTrack')

@section('content')
<div class="max-w-6xl mx-auto mb-12">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white flex items-center">
                <i class="bi bi-p-square-fill text-brand-500 mr-3"></i>Katalog & Manajemen Slot Parkir
            </h2>
            <p class="text-slate-400 text-sm mt-1">
                Modul HMVC Synchronous CRUD untuk memantau dan mengelola ketersediaan slot parkir.
            </p>
        </div>
        @if (auth()->user()->isOfficer())
            <a href="{{ route('slot-parkir.create') }}" class="bg-brand-500 hover:bg-brand-600 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-colors shadow-lg shadow-brand-500/20 flex items-center">
                <i class="bi bi-plus-lg mr-2"></i>Tambah Slot Parkir
            </a>
        @endif
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-4">
            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 block mb-1">Total Slot</span>
            <span class="text-2xl font-black text-white">{{ $summary['total'] }}</span>
        </div>
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-4">
            <span class="text-xs font-semibold uppercase tracking-wider text-emerald-400 block mb-1">Tersedia</span>
            <span class="text-2xl font-black text-emerald-400">{{ $summary['tersedia'] }}</span>
        </div>
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-4">
            <span class="text-xs font-semibold uppercase tracking-wider text-amber-400 block mb-1">Booking</span>
            <span class="text-2xl font-black text-amber-400">{{ $summary['booking'] }}</span>
        </div>
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-4">
            <span class="text-xs font-semibold uppercase tracking-wider text-red-400 block mb-1">Terisi</span>
            <span class="text-2xl font-black text-red-400">{{ $summary['terisi'] }}</span>
        </div>
    </div>

    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-lg">
        <div class="p-5 border-b border-slate-700">
            <form method="GET" action="{{ route('slot-parkir.index') }}" class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <i class="bi bi-search"></i>
                    </div>
                    <input
                        type="search"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari kode slot, lantai, atau tipe kendaraan..."
                        class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block pl-11 p-2.5"
                    >
                </div>
                <div class="sm:w-48">
                    <select
                        name="status"
                        onchange="this.form.submit()"
                        class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block p-2.5"
                    >
                        <option value="">Semua Status</option>
                        @foreach (['Tersedia', 'Booking', 'Terisi'] as $st)
                            <option value="{{ $st }}" @selected($selectedStatus === $st)>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <button type="submit" class="bg-brand-500 hover:bg-brand-600 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition-colors">
                        Cari
                    </button>
                    @if ($search !== '' || $selectedStatus !== '')
                        <a href="{{ route('slot-parkir.index') }}" class="border border-slate-600 text-slate-300 hover:text-white px-4 py-2.5 rounded-xl text-sm transition-colors">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-300">
                <thead class="text-xs text-slate-400 uppercase bg-slate-900/60 border-b border-slate-700">
                    <tr>
                        <th class="px-5 py-4 w-16">No</th>
                        <th class="px-5 py-4">Kode Slot</th>
                        <th class="px-5 py-4">Lokasi Lantai</th>
                        <th class="px-5 py-4">Tipe Kendaraan</th>
                        <th class="px-5 py-4">Tarif / Jam</th>
                        <th class="px-5 py-4">Status</th>
                        @if (auth()->user()->isOfficer())
                            <th class="px-5 py-4 text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse ($slots as $slot)
                        <tr class="hover:bg-slate-700/20 transition-colors">
                            <td class="px-5 py-4 text-slate-400">{{ $slots->firstItem() + $loop->index }}</td>
                            <td class="px-5 py-4">
                                <span class="bg-slate-900 px-3 py-1.5 rounded-lg text-white font-mono border border-slate-700 font-bold tracking-wider">
                                    {{ $slot->kode_slot }}
                                </span>
                            </td>
                            <td class="px-5 py-4 font-medium text-white">{{ $slot->lantai }}</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full {{ $slot->tipe_kendaraan === 'Mobil' ? 'bg-brand-500/15 text-brand-400 border border-brand-500/30' : 'bg-purple-500/15 text-purple-300 border border-purple-500/30' }}">
                                    <i class="bi {{ $slot->tipe_kendaraan === 'Mobil' ? 'bi-car-front-fill' : 'bi-scooter' }}"></i>
                                    {{ $slot->tipe_kendaraan }}
                                </span>
                            </td>
                            <td class="px-5 py-4 font-semibold text-white">
                                Rp {{ number_format($slot->tarif_per_jam, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-4">
                                @php
                                    $badgeStyle = match ($slot->status) {
                                        'Tersedia' => 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30',
                                        'Booking' => 'bg-amber-500/15 text-amber-400 border-amber-500/30',
                                        default => 'bg-red-500/15 text-red-400 border-red-500/30',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $badgeStyle }}">
                                    {{ $slot->status }}
                                </span>
                            </td>
                            @if (auth()->user()->isOfficer())
                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('slot-parkir.edit', $slot) }}" class="bg-amber-500/20 hover:bg-amber-500 text-amber-300 hover:text-slate-900 border border-amber-500/30 font-semibold px-3 py-1.5 rounded-lg text-xs transition-colors">
                                            <i class="bi bi-pencil mr-1"></i>Edit
                                        </a>
                                        <form action="{{ route('slot-parkir.destroy', $slot) }}" method="POST" class="inline" data-confirm="Slot parkir {{ $slot->kode_slot }} akan dihapus permanen.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white border border-red-500/30 font-semibold px-3 py-1.5 rounded-lg text-xs transition-colors cursor-pointer">
                                                <i class="bi bi-trash mr-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->isOfficer() ? 7 : 6 }}" class="px-5 py-12 text-center text-slate-400">
                                <i class="bi bi-p-circle text-4xl text-slate-600 block mb-2"></i>
                                <p>Belum ada data slot parkir yang sesuai.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($slots->hasPages())
            <div class="p-4 border-t border-slate-700 flex flex-wrap justify-between items-center gap-2 text-xs text-slate-400">
                <span>Menampilkan {{ $slots->firstItem() }}–{{ $slots->lastItem() }} dari {{ $slots->total() }} slot parkir</span>
                <div>{{ $slots->links() }}</div>
            </div>
        @endif
    </div>
</div>
@endsection
