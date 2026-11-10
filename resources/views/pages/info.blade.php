@extends('layouts.app')

@section('title', 'Informasi Area Parkir - ParkTrack')

@section('content')
<div class="mb-12">
    <div class="relative w-full h-[400px] rounded-3xl overflow-hidden mb-10 shadow-2xl group border border-slate-700">
        <div class="absolute inset-0 bg-slate-900/40 group-hover:bg-slate-900/30 transition-colors z-10"></div>
        <img src="{{ asset('img/logo/summarecon_mall.jpg') }}" alt="Summarecon Mall Bandung" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
        <div class="absolute inset-0 z-20 flex flex-col justify-end p-8 md:p-12 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent">
            <div class="flex items-center gap-3 mb-4">
                <span class="bg-brand-500 text-white text-xs font-bold px-3 py-1 rounded-full tracking-wider uppercase shadow-lg"><i class="bi bi-geo-alt-fill mr-1"></i> Gedebage, Bandung</span>
                <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full tracking-wider uppercase shadow-lg"><i class="bi bi-check-circle-fill mr-1"></i> Normal</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-white mb-2 tracking-tight">Summarecon Mall Bandung</h1>
            <p class="text-slate-300 max-w-2xl text-lg font-medium">Cek sisa slot dan pesan tempat parkir di Summaba tanpa pusing.</p>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-7 flex flex-col gap-8">
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-8 hover:border-slate-600 transition-colors">
                <h3 class="text-2xl font-bold text-white mb-6 flex items-center"><i class="bi bi-info-square-fill text-brand-500 mr-3"></i> Tentang Area Parkir</h3>
                <p class="text-slate-400 text-base leading-relaxed mb-6">
                    Mencari parkir saat akhir pekan sering kali membuang waktu. Oleh karena itu, area parkir Summarecon Mall Bandung (Summaba) dirancang agar pengunjung bisa langsung menemukan slot kosong tanpa perlu memutari blok berkali-kali.
                </p>
                <p class="text-slate-400 text-base leading-relaxed">
                    Saat ini, sistem ParkTrack sudah aktif di <strong>Area Parkir Utama</strong> dan <strong>Basement</strong>. Tiap lot parkir dipasangi sensor yang otomatis mendeteksi kendaran masuk. Datanya langsung dikirim ke sistem sentral, sehingga Anda bisa memantau sisa slot parkir secara <em>real-time</em> langsung dari HP.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-brand-500/10 flex items-center justify-center flex-shrink-0">
                        <i class="bi bi-camera-video-fill text-brand-500 text-xl"></i>
                    </div>
                    <div>
                        <h5 class="text-white font-bold mb-1">CCTV 24 Jam</h5>
                        <p class="text-slate-400 text-xs leading-relaxed">Pemantauan non-stop terintegrasi di seluruh sudut blok.</p>
                    </div>
                </div>
                <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-green-500/10 flex items-center justify-center flex-shrink-0">
                        <i class="bi bi-shield-check text-green-500 text-xl"></i>
                    </div>
                    <div>
                        <h5 class="text-white font-bold mb-1">Patroli Petugas</h5>
                        <p class="text-slate-400 text-xs leading-relaxed">Petugas profesional kami selalu bersiaga di lapangan.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-5">
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 h-full flex flex-col hover:border-slate-600 transition-colors">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center"><i class="bi bi-geo-alt-fill text-red-500 mr-3"></i> Lokasi Peta</h3>
                <div class="rounded-xl overflow-hidden border border-slate-700 h-[300px] mb-6 relative group">
                    <iframe src="https://maps.google.com/maps?q=Summarecon%20Mall%20Bandung&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="absolute inset-0"></iframe>
                    <div class="absolute inset-0 bg-brand-500/0 group-hover:bg-brand-500/10 transition-colors pointer-events-none"></div>
                </div>
                <a href="https://www.google.com/maps/search/?api=1&query=Summarecon+Mall+Bandung" target="_blank" class="w-full bg-white hover:bg-slate-100 text-slate-900 font-bold py-4 px-4 rounded-xl transition-colors shadow flex items-center justify-center text-sm uppercase tracking-wide mt-auto">
                    Buka di Google Maps <i class="bi bi-arrow-up-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="mt-12">
        <h3 class="text-2xl font-bold text-white mb-8 flex items-center"><i class="bi bi-car-front-fill text-brand-500 mr-3"></i> Tipe Area Parkir</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden hover:border-brand-500/50 transition-all duration-300 hover:-translate-y-1 group shadow-lg">
                <div class="h-48 overflow-hidden relative">
                    <img src="{{ asset('img/reguler.jpg') }}" alt="Reguler Parking" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 bg-slate-700/80 backdrop-blur-sm text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase border border-slate-600 shadow-sm">Reguler</div>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold text-white mb-3">Area Reguler</h4>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">Area parkir standar yang luas, berlokasi di setiap lantai dengan akses yang mudah menuju lobby utama.</p>
                    <div class="flex items-center justify-between border-t border-slate-700/50 pt-5 mt-auto">
                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Tarif Awal</span>
                        <span class="text-white font-black text-lg">Rp 4.000 <span class="text-xs text-slate-500 font-normal">/ Jam</span></span>
                    </div>
                </div>
            </div>
            <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden hover:border-brand-500 transition-all duration-300 hover:-translate-y-1 group shadow-lg">
                <div class="h-48 overflow-hidden relative">
                    <img src="{{ asset('img/vip.jpg') }}" alt="VIP Parking" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 bg-brand-500/90 backdrop-blur-sm text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase shadow-lg">VIP</div>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold text-white mb-3">Area VIP</h4>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">Berada persis di sebelah pintu masuk utama atau lift. Lebih aman, lebih lebar, dan akses keluar-masuk lebih cepat.</p>
                    <div class="flex items-center justify-between border-t border-slate-700/50 pt-5 mt-auto">
                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Tarif Awal</span>
                        <span class="text-brand-500 font-black text-lg">Rp 6.000 <span class="text-xs text-brand-500/70 font-normal">/ Jam</span></span>
                    </div>
                </div>
            </div>
            <div class="bg-slate-800 border border-amber-500/30 rounded-2xl overflow-hidden hover:border-amber-400 transition-all duration-300 hover:-translate-y-1 group relative shadow-[0_0_20px_rgba(245,158,11,0.1)]">
                <div class="h-48 overflow-hidden relative">
                    <img src="{{ asset('img/vvip.jpg') }}" alt="VVIP Parking" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 bg-gradient-to-r from-amber-500 to-yellow-400 text-slate-900 text-xs font-black px-4 py-1.5 rounded-full uppercase shadow-lg tracking-wider flex items-center">
                        <i class="bi bi-star-fill mr-1 text-[10px]"></i> VVIP
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold text-white mb-3 flex items-center">Area VVIP <i class="bi bi-patch-check-fill text-amber-500 ml-2 text-sm"></i></h4>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">Slot eksklusif bernomor 1-5 di setiap lantai. Menawarkan kenyamanan maksimal dengan ruang ekstra lega.</p>
                    <div class="flex items-center justify-between border-t border-slate-700/50 pt-5 mt-auto">
                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Tarif Awal</span>
                        <span class="text-amber-400 font-black text-lg">Rp 12.000 <span class="text-xs text-amber-400/70 font-normal">/ Jam</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection