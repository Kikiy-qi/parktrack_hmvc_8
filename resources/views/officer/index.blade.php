@extends('layouts.app')

@section('title', 'Dashboard Petugas - ParkTrack')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <div>
        <h2 class="font-bold text-white text-2xl">Dashboard Petugas</h2>
        <p class="text-slate-400">Ringkasan operasional ParkTrack hari ini.</p>
    </div>
    <div class="w-full md:w-auto text-right">
        <a href="{{ route('officer.penalty') }}" class="w-full md:w-auto inline-flex items-center justify-center bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-xl transition-colors shadow-sm">
            <i class="bi bi-shield-exclamation mr-2"></i> Catat Pelanggaran
        </a>
    </div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-slate-800 border border-slate-700 rounded-xl overflow-hidden hover:border-slate-600 transition-colors h-full flex flex-col">
        <div class="bg-slate-900 border-b border-slate-700 px-6 py-4 font-bold text-white flex items-center">
            <i class="bi bi-p-square-fill mr-2 text-brand-500"></i>Kapasitas & Status Slot
        </div>
        <div class="p-6 flex-grow flex flex-col justify-center">
            <div class="grid grid-cols-3 text-center mb-6 divide-x divide-slate-700">
                <div class="px-2">
                    <h2 class="text-green-500 font-bold text-3xl mb-1">{{ $slotsSummary['available'] ?? 0 }} <span class="text-slate-500 text-lg font-medium">/ {{ $totalSlots }}</span></h2>
                    <span class="text-slate-400 text-xs uppercase tracking-wide">Slot Tersedia</span>
                </div>
                <div class="px-2">
                    <h2 class="text-red-500 font-bold text-3xl mb-1">{{ $slotsSummary['occupied'] ?? 0 }}</h2>
                    <span class="text-slate-400 text-xs uppercase tracking-wide block mb-1.5">Slot Terisi</span>
                    <div class="text-xs text-slate-300 leading-relaxed font-medium bg-slate-900/50 p-1.5 rounded-lg border border-slate-700/50">
                        Reguler: <span class="text-white">{{ $occupiedByType['reguler'] ?? 0 }}</span> <span class="text-slate-500">/ {{ $totalByType['reguler'] ?? 0 }}</span><br>
                        VIP: <span class="text-white">{{ $occupiedByType['vip'] ?? 0 }}</span> <span class="text-slate-500">/ {{ $totalByType['vip'] ?? 0 }}</span> &bull; 
                        VVIP: <span class="text-white">{{ $occupiedByType['vvip'] ?? 0 }}</span> <span class="text-slate-500">/ {{ $totalByType['vvip'] ?? 0 }}</span>
                    </div>
                </div>
                <div class="px-2">
                    <h2 class="text-yellow-500 font-bold text-3xl mb-1">{{ $slotsSummary['reserved'] ?? 0 }}</h2>
                    <span class="text-slate-400 text-xs uppercase tracking-wide block mb-1.5">Slot Reservasi</span>
                    <div class="text-xs text-slate-300 leading-relaxed font-medium bg-slate-900/50 p-1.5 rounded-lg border border-slate-700/50">
                        Reguler: <span class="text-white">{{ $reservedByType['reguler'] ?? 0 }}</span> <span class="text-slate-500">/ {{ $totalByType['reguler'] ?? 0 }}</span><br>
                        VIP: <span class="text-white">{{ $reservedByType['vip'] ?? 0 }}</span> <span class="text-slate-500">/ {{ $totalByType['vip'] ?? 0 }}</span> &bull; 
                        VVIP: <span class="text-white">{{ $reservedByType['vvip'] ?? 0 }}</span> <span class="text-slate-500">/ {{ $totalByType['vvip'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
            @php 
                $av_pct = ($totalSlots > 0) ? ($slotsSummary['available'] / $totalSlots) * 100 : 0;
                $oc_pct = ($totalSlots > 0) ? ($slotsSummary['occupied'] / $totalSlots) * 100 : 0;
                $rs_pct = ($totalSlots > 0) ? ($slotsSummary['reserved'] / $totalSlots) * 100 : 0;
            @endphp
            <div class="w-full h-3 bg-slate-900 rounded-full overflow-hidden flex mb-3 border border-slate-700">
                <div class="bg-green-500 h-full" style="width: {{ $av_pct }}%"></div>
                <div class="bg-red-500 h-full" style="width: {{ $oc_pct }}%"></div>
                <div class="bg-yellow-500 h-full" style="width: {{ $rs_pct }}%"></div>
            </div>
            <p class="text-center text-xs text-slate-400 mt-2">Total: {{ $totalSlots }} Slot Parkir</p>
        </div>
    </div>
    <div class="bg-slate-800 border border-slate-700 rounded-xl overflow-hidden hover:border-slate-600 transition-colors h-full flex flex-col">
        <div class="bg-slate-900 border-b border-slate-700 px-6 py-4 font-bold text-white flex items-center">
            <i class="bi bi-cash-coin mr-2 text-brand-500"></i>Pendapatan (Hari Ini)
        </div>
        <div class="p-6 flex-grow flex flex-col justify-center">
            <ul class="space-y-4 mb-6">
                <li class="flex justify-between items-center pb-4 border-b border-slate-700">
                    <span class="text-slate-300 flex items-center"><i class="bi bi-phone text-brand-500 mr-3 text-lg"></i>Reservasi Online</span>
                    <span class="font-bold text-white">Rp {{ number_format($incomeReservations, 0, ',', '.') }}</span>
                </li>
                <li class="flex justify-between items-center pb-4 border-b border-slate-700">
                    <span class="text-slate-300 flex items-center"><i class="bi bi-exclamation-triangle text-red-500 mr-3 text-lg"></i>Pembayaran Denda</span>
                    <span class="font-bold text-white">Rp {{ number_format($incomePenalties, 0, ',', '.') }}</span>
                </li>
            </ul>
            <div class="bg-slate-900 border border-slate-700 rounded-xl p-4 text-center mt-auto">
                <span class="text-slate-400 text-xs uppercase tracking-wide mb-1 block">Total Pendapatan</span>
                <h3 class="text-green-500 font-bold text-3xl">Rp {{ number_format($incomeReservations + $incomePenalties, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
