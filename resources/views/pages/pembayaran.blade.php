@extends('layouts.app')

@section('title', 'Pembayaran - ParkTrack')

@section('content')
<div class="flex justify-center mb-12">
    <div class="w-full max-w-xl">
        <div class="text-center mb-8">
            <h2 class="font-bold text-white text-2xl mb-2 flex items-center justify-center">
                <i class="bi bi-credit-card text-brand-500 mr-3"></i>Pembayaran Reservasi
            </h2>
            <p class="text-slate-400">Selesaikan pembayaran Anda untuk konfirmasi slot parkir.</p>
        </div>

        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-8 hover:border-slate-600 transition-colors shadow-lg">
            <div class="bg-slate-900 border border-slate-700 rounded-xl p-6 text-center mb-8">
                <p class="text-slate-400 text-sm mb-2 uppercase tracking-wide">Total Tagihan Booking</p>
                <h1 class="font-bold text-brand-500 text-4xl mb-4">Rp 4.000</h1>
                <div class="inline-flex bg-slate-800 border border-slate-700 rounded-full px-4 py-1 text-xs text-slate-300">
                    ID Transaksi: TRX-{{ date('Ymd') }}-{{ rand(1000, 9999) }}
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-slate-400 text-sm font-semibold mb-3">Pilih Metode Pembayaran</label>
                <div class="space-y-3">
                    <label class="flex items-center p-4 border border-slate-700 rounded-xl cursor-pointer hover:bg-slate-700/50 transition-colors has-[:checked]:border-brand-500 has-[:checked]:bg-brand-500/10">
                        <input type="radio" name="payment_method" value="qris" class="w-4 h-4 text-brand-500 bg-slate-900 border-slate-700 focus:ring-brand-500" checked>
                        <div class="ml-3 flex-grow flex justify-between items-center">
                            <span class="font-bold text-white flex items-center"><i class="bi bi-qr-code text-brand-500 mr-2 text-xl"></i> QRIS (Instan)</span>
                            <span class="text-xs bg-brand-500/20 text-brand-400 px-2.5 py-0.5 rounded-full font-semibold">Otomatis / Cepat</span>
                        </div>
                    </label>
                    <label class="flex items-center p-4 border border-slate-700 rounded-xl cursor-pointer hover:bg-slate-700/50 transition-colors has-[:checked]:border-brand-500 has-[:checked]:bg-brand-500/10">
                        <input type="radio" name="payment_method" value="transfer" class="w-4 h-4 text-brand-500 bg-slate-900 border-slate-700 focus:ring-brand-500">
                        <div class="ml-3 flex-grow flex justify-between items-center">
                            <span class="font-bold text-white flex items-center"><i class="bi bi-bank text-brand-500 mr-2 text-xl"></i> Transfer Bank / Virtual Account</span>
                            <span class="text-xs text-slate-400">BCA, Mandiri, BRI</span>
                        </div>
                    </label>
                    <label class="flex items-center p-4 border border-slate-700 rounded-xl cursor-pointer hover:bg-slate-700/50 transition-colors has-[:checked]:border-brand-500 has-[:checked]:bg-brand-500/10">
                        <input type="radio" name="payment_method" value="ewallet" class="w-4 h-4 text-brand-500 bg-slate-900 border-slate-700 focus:ring-brand-500">
                        <div class="ml-3 flex-grow flex justify-between items-center">
                            <span class="font-bold text-white flex items-center"><i class="bi bi-phone text-brand-500 mr-2 text-xl"></i> E-Wallet</span>
                            <span class="text-xs text-slate-400">GoPay, DANA, OVO</span>
                        </div>
                    </label>
                </div>
            </div>

            <a href="/reservasi" class="w-full block text-center bg-brand-500 hover:bg-brand-600 text-white font-bold py-3.5 px-4 rounded-xl transition-colors shadow">
                Lanjutkan Pembayaran
            </a>
        </div>
    </div>
</div>
@endsection