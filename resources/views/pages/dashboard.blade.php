@extends('layouts.app')

@section('title', 'ParkTrack - Solusi Parkir Cerdas')

@section('content')
<div class="flex flex-col md:flex-row items-center justify-between py-12 md:py-20 gap-12">
    <div class="md:w-1/2">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">Parkir Tanpa Pusing dengan <span class="text-brand-500">ParkTrack</span></h1>
        <p class="text-lg text-slate-400 mb-8 leading-relaxed">Booking tempat parkir jadi lebih praktis! Bayar reservasi di aplikasi, bayar durasi di lokasi. Cek denda juga bisa dilakukan tanpa login.</p>
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="/reservasi" class="bg-brand-500 hover:bg-brand-600 text-white text-center font-bold px-8 py-4 rounded-xl transition-colors shadow-lg">Reservasi Sekarang</a>
            <a href="/data-parkir" class="border border-slate-600 text-slate-300 hover:bg-slate-800 hover:text-white text-center font-bold px-8 py-4 rounded-xl transition-colors">Lihat Data Parkir</a>
        </div>
    </div>
    <div class="md:w-1/2 w-full max-w-md mx-auto">
        <div class="bg-slate-800 border border-slate-700 p-10 rounded-2xl text-center hover:border-slate-600 transition-colors shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500/10 rounded-full blur-3xl -mr-10 -mt-10"></div>
            <i class="bi bi-p-square-fill text-brand-500 text-6xl mb-4 inline-block relative z-10"></i>
            <h1 class="text-6xl font-black text-white mb-2 relative z-10">{{ $available_slots ?? 15 }}</h1>
            <h3 class="text-xl font-bold text-brand-500 mb-3 relative z-10 uppercase tracking-wider">Slot Tersedia</h3>
            <p class="text-slate-400 relative z-10 text-sm">Sistem kami terhubung langsung dengan sensor ultrasonik di setiap blok parkir secara real-time.</p>
        </div>
    </div>
</div>
@endsection