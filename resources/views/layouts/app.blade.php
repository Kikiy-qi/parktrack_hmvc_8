<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ParkTrack - Solusi Parkir Cerdas')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            400: '#60A5FA',
                            500: '#3B82F6',
                            600: '#2563EB',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-slate-900 text-slate-50 min-h-screen flex flex-col font-sans overflow-x-hidden">

<div class="container mx-auto px-4 mt-5">
    <nav class="flex justify-between items-center py-3 hide-on-print relative">
        <a class="flex items-center gap-2 text-decoration-none group shrink-0" href="{{ auth()->check() ? route('dashboard') : route('login') }}">
            <img src="{{ asset('img/logo/Logo_new_crop.png') }}" alt="ParkTrack Logo" class="h-10 w-auto object-contain transition-transform group-hover:scale-105">
            <img src="{{ asset('img/logo/Nama_new_crop.png') }}" alt="ParkTrack Text" class="h-6 w-auto object-contain mt-1">
        </a>

        @auth
            <div id="mainNav" class="hidden lg:flex flex-col lg:flex-row absolute lg:relative top-full mt-2 lg:mt-0 left-0 right-0 bg-slate-800 border border-slate-700 rounded-2xl lg:rounded-full p-4 lg:p-1.5 items-stretch lg:items-center z-40 gap-1.5 lg:gap-1 shadow-xl lg:shadow-none">
                <a href="{{ route('dashboard') }}" class="rounded-full px-4 py-2 text-xs font-semibold transition-colors {{ request()->routeIs('dashboard') ? 'bg-brand-500 text-white' : 'text-slate-300 hover:text-white' }}">
                    <i class="bi bi-grid-fill mr-1.5"></i>Dashboard
                </a>
                <a href="{{ route('slot-parkir.index') }}" class="rounded-full px-4 py-2 text-xs font-semibold transition-colors {{ request()->routeIs('slot-parkir.*') ? 'bg-brand-500 text-white' : 'text-slate-300 hover:text-white' }}">
                    <i class="bi bi-p-square-fill mr-1.5"></i>Slot Parkir
                </a>
                <a href="{{ route('pengaduan.index') }}" class="rounded-full px-4 py-2 text-xs font-semibold transition-colors {{ request()->routeIs('pengaduan.*') ? 'bg-brand-500 text-white' : 'text-slate-300 hover:text-white' }}">
                    <i class="bi bi-chat-left-dots-fill mr-1.5"></i>Pengaduan (AJAX)
                </a>
                <a href="{{ route('reservasi.form') }}" class="rounded-full px-4 py-2 text-xs font-semibold transition-colors {{ request()->routeIs('reservasi.*') ? 'bg-brand-500 text-white' : 'text-slate-300 hover:text-white' }}">
                    <i class="bi bi-calendar-check-fill mr-1.5"></i>Reservasi
                </a>
                <a href="{{ route('status') }}" class="rounded-full px-4 py-2 text-xs font-semibold transition-colors {{ request()->routeIs('status') ? 'bg-brand-500 text-white' : 'text-slate-300 hover:text-white' }}">
                    <i class="bi bi-ticket-detailed-fill mr-1.5"></i>Status Tiket
                </a>
                @if (auth()->user()->isOfficer())
                    <a href="{{ route('officer.list_parking') }}" class="rounded-full px-4 py-2 text-xs font-semibold transition-colors {{ request()->routeIs('officer.*') ? 'bg-brand-500 text-white' : 'text-slate-300 hover:text-white' }}">
                        <i class="bi bi-list-columns mr-1.5"></i>Operasional
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="rounded-full px-4 py-2 text-xs font-semibold transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-brand-500 text-white' : 'text-slate-300 hover:text-white' }}">
                        <i class="bi bi-people-fill mr-1.5"></i>Kelola User
                    </a>
                @endif
            </div>
        @endauth

        <div class="flex items-center gap-3">
            <button onclick="toggleTheme()" class="w-9 h-9 rounded-full border border-slate-700 bg-slate-800 text-slate-400 hover:text-white hover:border-slate-600 flex items-center justify-center transition-colors cursor-pointer" title="Toggle Light/Dark Mode">
                <i id="theme-icon" class="bi bi-sun-fill text-sm"></i>
            </button>

            @auth
                <div class="hidden sm:block text-right">
                    <div class="font-bold text-white text-sm leading-tight">{{ auth()->user()->name }}</div>
                    <div class="text-[11px] font-bold uppercase tracking-wider {{ auth()->user()->isOfficer() ? 'text-amber-400' : 'text-brand-400' }}">
                        {{ auth()->user()->role->label() }}
                    </div>
                </div>
                <div class="w-9 h-9 rounded-full bg-brand-500 text-white flex items-center justify-center font-bold text-xs">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="w-9 h-9 rounded-full border border-red-500/30 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors cursor-pointer" title="Keluar">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
                <button type="button" class="lg:hidden bg-slate-800 text-white rounded-lg p-2 border border-slate-700" onclick="document.getElementById('mainNav').classList.toggle('hidden');">
                    <i class="bi bi-list text-xl"></i>
                </button>
            @else
                <a href="{{ route('login') }}" class="border border-slate-600 hover:bg-slate-800 text-white px-5 py-2 rounded-full text-xs font-semibold transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="bg-brand-500 hover:bg-brand-600 text-white px-5 py-2 rounded-full text-xs font-semibold transition-colors">Daftar</a>
            @endauth
        </div>
    </nav>
</div>

<main class="container mx-auto px-4 mt-6 mb-16 flex-grow">
    @if (session('success'))
        <div class="max-w-6xl mx-auto mb-6 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 px-4 py-3 rounded-xl flex items-center justify-between gap-2 alert-autohide">
            <div class="flex items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-300 hover:text-white cursor-pointer">
                <i class="bi bi-x-lg text-xs"></i>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-6xl mx-auto mb-6 bg-red-500/20 border border-red-500/40 text-red-300 px-4 py-3 rounded-xl flex items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-red-300 hover:text-white cursor-pointer">
                <i class="bi bi-x-lg text-xs"></i>
            </button>
        </div>
    @endif

    @yield('content')
</main>

<footer class="bg-slate-900 border-t border-slate-800 text-slate-500 py-6 mt-auto">
    <div class="container mx-auto px-4 text-center text-sm">
        <p>&copy; {{ date('Y') }} ParkTrack — Sistem Informasi Parkir Cerdas Berbasis HMVC.</p>
    </div>
</footer>

<div id="confirmModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/75 backdrop-blur-xs p-4">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center">
        <div class="w-12 h-12 rounded-full bg-red-500/20 text-red-400 flex items-center justify-center mx-auto mb-3 text-2xl">
            <i class="bi bi-exclamation-circle"></i>
        </div>
        <h6 class="font-bold text-white text-base mb-1" id="confirmModalLabel">Konfirmasi Hapus</h6>
        <p class="text-slate-400 text-xs mb-5" id="confirmModalMessage"></p>
        <div class="flex justify-center gap-3">
            <button type="button" id="confirmModalNo" class="border border-slate-600 text-slate-300 hover:text-white px-4 py-2 rounded-xl text-xs font-semibold cursor-pointer">
                Batal
            </button>
            <button type="button" id="confirmModalYes" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-xs font-bold cursor-pointer">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function toggleTheme() {
        document.body.classList.toggle('light-mode');
        const isLight = document.body.classList.contains('light-mode');
        localStorage.setItem('theme', isLight ? 'light' : 'dark');
        updateThemeIcon();
    }

    function updateThemeIcon() {
        const isLight = document.body.classList.contains('light-mode');
        const icon = document.getElementById('theme-icon');
        if (icon) {
            icon.className = isLight ? 'bi bi-moon-fill text-sm' : 'bi bi-sun-fill text-sm';
        }
    }

    window.confirmDelete = function (message) {
        const modal = document.getElementById('confirmModal');
        document.getElementById('confirmModalMessage').textContent = message;
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        return new Promise(function (resolve) {
            const yesBtn = document.getElementById('confirmModalYes');
            const noBtn = document.getElementById('confirmModalNo');

            function cleanup(result) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
                yesBtn.onclick = null;
                noBtn.onclick = null;
                resolve(result);
            }

            yesBtn.onclick = function () { cleanup(true); };
            noBtn.onclick = function () { cleanup(false); };
        });
    };

    document.addEventListener('DOMContentLoaded', function () {
        if (localStorage.getItem('theme') === 'light') {
            document.body.classList.add('light-mode');
        }
        updateThemeIcon();

        document.querySelectorAll('form[data-confirm]').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                window.confirmDelete(form.dataset.confirm).then(function (confirmed) {
                    if (confirmed) {
                        form.submit();
                    }
                });
            });
        });

        document.querySelectorAll('[data-toggle-password]').forEach(function (button) {
            button.addEventListener('click', function () {
                const input = document.getElementById(button.dataset.togglePassword);
                if (! input) return;
                const isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';
                button.querySelector('i').className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
            });
        });

        document.querySelectorAll('.alert-autohide').forEach(function (alertEl) {
            setTimeout(function () {
                alertEl.remove();
            }, 4000);
        });
    });
</script>
@stack('scripts')
</body>
</html>
