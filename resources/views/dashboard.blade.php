@extends('layouts.app')

@section('title', 'Dashboard - ParkTrack')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 md:p-8 mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 shadow-xl">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold border mb-3 {{ auth()->user()->isOfficer() ? 'bg-amber-500/15 text-amber-400 border-amber-500/30' : 'bg-brand-500/15 text-brand-400 border-brand-500/30' }}">
                <i class="bi bi-shield-check"></i>
                <span>Hak Akses Aktif: {{ auth()->user()->role->label() }}</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                Halo, {{ auth()->user()->name }}!
            </h1>
            <p class="text-slate-400 text-sm max-w-2xl">
                Selamat datang di sistem manajemen parkir cerdas <strong>ParkTrack</strong> berbasis arsitektur HMVC. Pilih modul di bawah ini untuk mengelola data slot parkir, pengaduan, maupun reservasi.
            </p>
        </div>
        <div class="flex flex-wrap gap-3 shrink-0">
            <a href="{{ route('slot-parkir.index') }}" class="bg-brand-500 hover:bg-brand-600 text-white font-bold px-5 py-3 rounded-xl text-sm transition-colors shadow-lg shadow-brand-500/20 flex items-center">
                <i class="bi bi-p-square-fill mr-2"></i>Katalog Slot Parkir
            </a>
            <a href="{{ route('pengaduan.index') }}" class="border border-slate-600 hover:bg-slate-700 text-white font-semibold px-5 py-3 rounded-xl text-sm transition-colors flex items-center">
                <i class="bi bi-chat-left-dots-fill mr-2 text-brand-400"></i>Pengaduan (AJAX)
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 flex flex-col justify-between hover:border-slate-600 transition-colors">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Slot Tersedia</span>
                    <span class="w-9 h-9 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center">
                        <i class="bi bi-p-square-fill"></i>
                    </span>
                </div>
                <div class="text-3xl font-black text-white mb-1">
                    {{ $availableSlots }} <span class="text-base font-medium text-slate-400">/ {{ $totalSlots }}</span>
                </div>
                <p class="text-xs text-slate-400 mb-4">Modul HMVC Synchronous CRUD</p>
            </div>
            <a href="{{ route('slot-parkir.index') }}" class="text-xs font-bold text-brand-400 hover:text-brand-300 inline-flex items-center">
                Kelola Slot Parkir <i class="bi bi-arrow-right ml-1.5"></i>
            </a>
        </div>

        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 flex flex-col justify-between hover:border-slate-600 transition-colors">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Data Pengaduan</span>
                    <span class="w-9 h-9 rounded-xl bg-brand-500/15 text-brand-400 flex items-center justify-center">
                        <i class="bi bi-chat-left-dots-fill"></i>
                    </span>
                </div>
                <div class="text-3xl font-black text-white mb-1">{{ $totalPengaduan }}</div>
                <p class="text-xs text-slate-400 mb-4">Modul HMVC AJAX + Upload Bukti</p>
            </div>
            <a href="{{ route('pengaduan.index') }}" class="text-xs font-bold text-brand-400 hover:text-brand-300 inline-flex items-center">
                Buka Pengaduan AJAX <i class="bi bi-arrow-right ml-1.5"></i>
            </a>
        </div>

        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 flex flex-col justify-between hover:border-slate-600 transition-colors">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Tiket Reservasi</span>
                    <span class="w-9 h-9 rounded-xl bg-amber-500/15 text-amber-400 flex items-center justify-center">
                        <i class="bi bi-ticket-detailed-fill"></i>
                    </span>
                </div>
                <div class="text-3xl font-black text-white mb-1">{{ $totalReservasi }}</div>
                <p class="text-xs text-slate-400 mb-4">Pemesanan & Status Tiket</p>
            </div>
            <a href="{{ route('status') }}" class="text-xs font-bold text-brand-400 hover:text-brand-300 inline-flex items-center">
                Lihat Status Tiket <i class="bi bi-arrow-right ml-1.5"></i>
            </a>
        </div>

        @if (auth()->user()->isOfficer())
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 flex flex-col justify-between hover:border-slate-600 transition-colors">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Pengguna</span>
                        <span class="w-9 h-9 rounded-xl bg-purple-500/15 text-purple-400 flex items-center justify-center">
                            <i class="bi bi-people-fill"></i>
                        </span>
                    </div>
                    <div class="text-3xl font-black text-white mb-1">{{ $totalUsers }}</div>
                    <p class="text-xs text-slate-400 mb-4">Modul HMVC UserManagement</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-brand-400 hover:text-brand-300 inline-flex items-center">
                    Kelola Akun Pengguna <i class="bi bi-arrow-right ml-1.5"></i>
                </a>
            </div>
        @else
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 flex flex-col justify-between hover:border-slate-600 transition-colors">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Info & Tarif Denda</span>
                        <span class="w-9 h-9 rounded-xl bg-purple-500/15 text-purple-400 flex items-center justify-center">
                            <i class="bi bi-info-circle-fill"></i>
                        </span>
                    </div>
                    <div class="text-xl font-bold text-white mb-1">Summaba Area</div>
                    <p class="text-xs text-slate-400 mb-4">Informasi zona & aturan parkir</p>
                </div>
                <a href="{{ route('info') }}" class="text-xs font-bold text-brand-400 hover:text-brand-300 inline-flex items-center">
                    Lihat Info Area <i class="bi bi-arrow-right ml-1.5"></i>
                </a>
            </div>
        @endif
    </div>

    @if (auth()->user()->isOfficer())
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-white text-lg">Portal Operasional Petugas ParkTrack</h3>
                <p class="text-slate-400 text-xs mt-0.5">Akses cepat ke ringkasan pendapatan, pemantauan daftar parkir, cek pengguna, dan pencatatan denda.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('officer.index') }}" class="bg-slate-900 hover:bg-slate-700 border border-slate-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors">
                    <i class="bi bi-speedometer2 mr-1 text-brand-400"></i>Dashboard Petugas
                </a>
                <a href="{{ route('officer.list_parking') }}" class="bg-slate-900 hover:bg-slate-700 border border-slate-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors">
                    <i class="bi bi-list-columns mr-1 text-brand-400"></i>Daftar Parkir
                </a>
                <a href="{{ route('officer.penalty') }}" class="bg-slate-900 hover:bg-slate-700 border border-slate-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors">
                    <i class="bi bi-shield-exclamation mr-1 text-red-400"></i>Catat Denda
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
