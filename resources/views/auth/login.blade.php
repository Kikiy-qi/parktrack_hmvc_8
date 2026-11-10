@extends('layouts.app')

@section('title', 'Masuk ke ParkTrack')

@section('content')
<div class="flex justify-center items-center py-8">
    <div class="w-full max-w-md">
        <div class="bg-slate-800 border border-slate-700 rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-slate-900 border-b border-slate-700 p-6 text-center">
                <div class="w-12 h-12 rounded-xl bg-brand-500/20 text-brand-400 flex items-center justify-center mx-auto mb-3 text-2xl">
                    <i class="bi bi-p-square-fill"></i>
                </div>
                <h4 class="font-bold text-white text-xl tracking-tight">Masuk ke ParkTrack</h4>
                <p class="text-slate-400 text-sm mt-1">Masuk untuk mengakses pengelolaan slot parkir, reservasi, dan pengaduan.</p>
            </div>
            <div class="p-8">
                <form action="{{ route('login.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="mb-5">
                        <label for="loginEmail" class="block text-slate-300 text-sm font-semibold mb-2">Alamat Email / Nomor Telepon</label>
                        <input
                            type="text"
                            id="loginEmail"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="admin@parktrack.com / user@gmail.com"
                            class="w-full bg-slate-900 border @error('email') border-red-500 @else border-slate-700 @enderror text-slate-50 placeholder:text-slate-500 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3"
                        >
                        @error('email')
                            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="loginPassword" class="block text-slate-300 text-sm font-semibold mb-2">Kata Sandi</label>
                        <div class="relative">
                            <input
                                type="password"
                                id="loginPassword"
                                name="password"
                                required
                                placeholder="Masukkan kata sandi"
                                class="w-full bg-slate-900 border @error('password') border-red-500 @else border-slate-700 @enderror text-slate-50 placeholder:text-slate-500 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3 pr-11"
                            >
                            <button type="button" data-toggle-password="loginPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white transition-colors p-1 cursor-pointer">
                                <i class="bi bi-eye text-lg"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center mb-6">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-brand-500 focus:ring-brand-500">
                        <label for="remember" class="ml-2 text-xs text-slate-400">Ingat sesi masuk saya</label>
                    </div>

                    <button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-3 px-4 rounded-xl transition-colors mb-4 shadow-lg shadow-brand-500/20 cursor-pointer">
                        Masuk
                    </button>

                    <div class="text-center mt-4">
                        <span class="text-slate-400 text-sm">Belum memiliki akun?</span>
                        <a href="{{ route('register') }}" class="text-brand-400 hover:text-brand-300 text-sm font-bold ml-1 transition-colors">Daftar di sini</a>
                    </div>

                    <div class="mt-6 pt-5 border-t border-slate-700/60">
                        <p class="text-center text-xs text-slate-400 mb-3">Akun Demo Pengujian Role:</p>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="button" onclick="fillDemo('admin@parktrack.com', 'password123')" class="text-xs bg-slate-900 hover:bg-slate-700 border border-slate-700 text-amber-400 font-semibold px-3 py-2 rounded-xl transition-colors cursor-pointer">
                                <i class="bi bi-shield-lock-fill mr-1"></i>Petugas (Officer)
                            </button>
                            <button type="button" onclick="fillDemo('user@gmail.com', 'password123')" class="text-xs bg-slate-900 hover:bg-slate-700 border border-slate-700 text-brand-400 font-semibold px-3 py-2 rounded-xl transition-colors cursor-pointer">
                                <i class="bi bi-person-fill mr-1"></i>Pengendara (User)
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function fillDemo(email, password) {
        document.getElementById('loginEmail').value = email;
        document.getElementById('loginPassword').value = password;
    }
</script>
@endpush
@endsection
