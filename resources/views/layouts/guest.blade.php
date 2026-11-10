<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials.head')
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-4">
            <div class="col-sm-10 col-md-7 col-lg-5 col-xl-4">
                <div class="mb-4">
                    <span class="auth-logo mb-2"><i class="bi bi-journal-bookmark-fill"></i></span>
                    <h4 class="fw-bold mb-0">{{ config('app.name', 'SiPustaka') }}</h4>
                    <p class="text-muted small mb-0">Sistem Informasi Perpustakaan Kampus</p>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.partials.scripts')
</body>
</html>