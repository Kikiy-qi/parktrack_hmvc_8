@extends('layouts.app')

@section('title', 'Cek Denda Parkir - ParkTrack')

@section('content')
<div class="mb-12">
    <div class="text-center mb-8">
        <h2 class="font-bold text-white text-3xl mb-2 flex items-center justify-center">
            <i class="bi bi-shield-exclamation text-brand-500 mr-3"></i>Status & Riwayat Denda Parkir
        </h2>
        <p class="text-slate-400 text-sm max-w-xl mx-auto">
            Sistem secara otomatis mendeteksi status pelanggaran dan denda parkir untuk semua kendaraan yang terdaftar di sistem ParkTrack.
        </p>
    </div>

    <div class="max-w-2xl mx-auto mb-10">
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-xl">
            <form action="{{ route('denda') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-center">
                <div class="relative flex-1 w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <i class="bi bi-search"></i>
                    </div>
                    <input type="text" name="plat" value="{{ request('plat') }}" class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block pl-11 p-3 uppercase font-mono tracking-wider" placeholder="Masukkan Plat Nomor (Contoh: B 1234 ABC)">
                </div>
                <button type="submit" class="w-full sm:w-auto bg-brand-500 hover:bg-brand-600 text-white font-bold py-3 px-6 rounded-xl transition-colors shadow whitespace-nowrap">
                    Cek Denda
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-emerald-500/10 border border-emerald-500/40 rounded-2xl p-5 mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-2xl shrink-0">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <h5 class="font-bold text-white text-lg mb-0.5">Sistem Integrasi Penegakan Disiplin</h5>
                    <p class="text-xs text-emerald-300 mb-0">Petugas lapangan melakukan patroli rutin untuk menjaga ketertiban area parkir.</p>
                </div>
            </div>
            <span class="bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 text-xs font-bold px-3 py-1.5 rounded-full uppercase">
                Aktif
            </span>
        </div>

        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-lg">
            <h4 class="font-bold text-white text-lg mb-4 flex items-center">
                <i class="bi bi-exclamation-octagon text-amber-400 mr-2"></i> Ketentuan Denda & Tarif Pelanggaran
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-slate-900/60 border border-slate-700/60 p-4 rounded-xl">
                    <div class="text-xs text-slate-400 uppercase font-bold mb-1">Tiket Hilang</div>
                    <div class="text-xl font-bold text-white mb-2">Rp 50.000</div>
                    <p class="text-xs text-slate-400">Dikenakan bila karcis/bukti QR fisik atau digital hilang saat keluar gate.</p>
                </div>
                <div class="bg-slate-900/60 border border-slate-700/60 p-4 rounded-xl">
                    <div class="text-xs text-slate-400 uppercase font-bold mb-1">Parkir Sembarangan</div>
                    <div class="text-xl font-bold text-white mb-2">Rp 25.000</div>
                    <p class="text-xs text-slate-400">Parkir di luar marka, menghalangi jalur evakuasi, atau memakan 2 slot.</p>
                </div>
                <div class="bg-slate-900/60 border border-slate-700/60 p-4 rounded-xl">
                    <div class="text-xs text-slate-400 uppercase font-bold mb-1">Salah Tipe Slot</div>
                    <div class="text-xl font-bold text-white mb-2">Rp 30.000</div>
                    <p class="text-xs text-slate-400">Mobil reguler yang menempati slot VIP/VVIP tanpa melakukan reservasi.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
