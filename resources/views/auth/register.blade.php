@extends('layouts.app')

@section('title', 'Daftar Akun Baru - ParkTrack')

@section('content')
<div class="flex justify-center items-center py-8">
    <div class="w-full max-w-md">
        <div class="bg-slate-800 border border-slate-700 rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-slate-900 border-b border-slate-700 p-6 text-center">
                <h4 class="font-bold text-white text-xl tracking-tight">Daftar Akun Baru</h4>
                <p class="text-slate-400 text-sm mt-1">Daftarkan akun pengendara untuk akses layanan ParkTrack.</p>
            </div>
            <div class="p-8">
                <form action="{{ route('register.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="mb-4">
                        <label for="regName" class="block text-slate-300 text-sm font-semibold mb-2">Nama Lengkap</label>
                        <input
                            type="text"
                            id="regName"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="Nama lengkap sesuai identitas"
                            class="w-full bg-slate-900 border @error('name') border-red-500 @else border-slate-700 @enderror text-slate-50 placeholder:text-slate-500 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3"
                        >
                        @error('name')
                            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="regEmail" class="block text-slate-300 text-sm font-semibold mb-2">Alamat Email</label>
                        <input
                            type="email"
                            id="regEmail"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="nama@gmail.com"
                            class="w-full bg-slate-900 border @error('email') border-red-500 @else border-slate-700 @enderror text-slate-50 placeholder:text-slate-500 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3"
                        >
                        @error('email')
                            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="regPhone" class="block text-slate-300 text-sm font-semibold mb-2">Nomor Telepon</label>
                        <input
                            type="text"
                            id="regPhone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="081234567890"
                            class="w-full bg-slate-900 border @error('phone') border-red-500 @else border-slate-700 @enderror text-slate-50 placeholder:text-slate-500 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3"
                        >
                        @error('phone')
                            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="regPassword" class="block text-slate-300 text-sm font-semibold mb-2">Kata Sandi</label>
                        <div class="relative">
                            <input
                                type="password"
                                id="regPassword"
                                name="password"
                                required
                                placeholder="Minimal 8 karakter"
                                class="w-full bg-slate-900 border @error('password') border-red-500 @else border-slate-700 @enderror text-slate-50 placeholder:text-slate-500 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3 pr-11"
                            >
                            <button type="button" data-toggle-password="regPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white transition-colors p-1 cursor-pointer">
                                <i class="bi bi-eye text-lg"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="regPasswordConfirmation" class="block text-slate-300 text-sm font-semibold mb-2">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <input
                                type="password"
                                id="regPasswordConfirmation"
                                name="password_confirmation"
                                required
                                placeholder="Ulangi kata sandi"
                                class="w-full bg-slate-900 border border-slate-700 text-slate-50 placeholder:text-slate-500 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3 pr-11"
                            >
                            <button type="button" data-toggle-password="regPasswordConfirmation" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white transition-colors p-1 cursor-pointer">
                                <i class="bi bi-eye text-lg"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-3 px-4 rounded-xl transition-colors mb-4 shadow-lg shadow-brand-500/20 cursor-pointer">
                        Daftar Sekarang
                    </button>

                    <div class="text-center mt-4">
                        <span class="text-slate-400 text-sm">Sudah memiliki akun?</span>
                        <a href="{{ route('login') }}" class="text-brand-400 hover:text-brand-300 text-sm font-bold ml-1 transition-colors">Masuk di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
