@extends('layouts.app')

@section('title', 'Reservasi Slot - ParkTrack')

@section('content')
<div class="mb-8">
    <h3 class="font-bold text-white text-xl mb-6">Reservasi Slot</h3>

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/40 text-emerald-400 px-4 py-3 rounded-xl mb-6 flex items-center">
            <i class="bi bi-check-circle-fill mr-3 text-lg"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('reservasi.proses') }}" method="POST" class="grid grid-cols-1 md:grid-cols-12 gap-6 max-w-full">
        @csrf
        <div class="md:col-span-7 min-w-0 max-w-full">
            <div class="bg-slate-800 border border-slate-700 rounded-xl p-4 sm:p-6 h-full hover:border-slate-600 transition-colors overflow-hidden">
                <h6 class="font-bold text-white mb-6">Booking Details</h6>
                <div class="mb-5">
                    <div class="flex items-center justify-between mb-2">
                        <label for="expected_entry_time" class="block text-slate-300 text-sm font-semibold">
                            <i class="bi bi-clock-history text-brand-500 mr-1.5"></i> Waktu & Tanggal Kedatangan
                        </label>
                        <span class="text-xs text-brand-400 font-medium">Bisa pilih tanggal & jam</span>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-2">
                        <div class="relative flex-1 min-w-0">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="bi bi-calendar3"></i>
                            </div>
                            <input 
                                type="datetime-local" 
                                id="expected_entry_time" 
                                name="expected_entry_time" 
                                class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block pl-10 p-2.5 cursor-pointer"
                                style="color-scheme: dark;"
                                value="{{ date('Y-m-d\TH:i') }}"
                                min="{{ date('Y-m-d\TH:i') }}"
                                required
                            >
                        </div>
                        <button 
                            type="button" 
                            id="btn_open_picker"
                            onclick="openDateTimePicker()" 
                            class="bg-brand-500 hover:bg-brand-600 text-white font-semibold px-4 py-2.5 rounded-lg text-sm flex items-center gap-2 transition-all active:scale-95 shadow-lg shadow-brand-500/20 whitespace-nowrap cursor-pointer"
                        >
                            <i class="bi bi-calendar2-week"></i>
                            <span>Pilih Waktu</span>
                        </button>
                    </div>
                    <div class="mt-2.5">
                        <span class="text-[11px] text-slate-400 block mb-1.5 font-medium">Pilihan Cepat:</span>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" onclick="setPresetMinutes(0)" class="text-xs bg-slate-900/90 border border-slate-700 hover:border-brand-500 hover:text-brand-400 text-slate-300 px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1 active:scale-95 cursor-pointer">
                                <i class="bi bi-lightning-charge-fill text-amber-400 text-xs"></i> Sekarang
                            </button>
                            <button type="button" onclick="setPresetMinutes(15)" class="text-xs bg-slate-900/90 border border-slate-700 hover:border-brand-500 hover:text-brand-400 text-slate-300 px-3 py-1.5 rounded-lg transition-colors active:scale-95 cursor-pointer">
                                +15 Menit
                            </button>
                            <button type="button" onclick="setPresetMinutes(30)" class="text-xs bg-slate-900/90 border border-slate-700 hover:border-brand-500 hover:text-brand-400 text-slate-300 px-3 py-1.5 rounded-lg transition-colors active:scale-95 cursor-pointer">
                                +30 Menit
                            </button>
                            <button type="button" onclick="setPresetMinutes(60)" class="text-xs bg-slate-900/90 border border-slate-700 hover:border-brand-500 hover:text-brand-400 text-slate-300 px-3 py-1.5 rounded-lg transition-colors active:scale-95 cursor-pointer">
                                +1 Jam
                            </button>
                            <button type="button" onclick="setPresetMinutes(120)" class="text-xs bg-slate-900/90 border border-slate-700 hover:border-brand-500 hover:text-brand-400 text-slate-300 px-3 py-1.5 rounded-lg transition-colors active:scale-95 cursor-pointer">
                                +2 Jam
                            </button>
                            <button type="button" onclick="setPresetTomorrow(9)" class="text-xs bg-slate-900/90 border border-slate-700 hover:border-brand-500 hover:text-brand-400 text-slate-300 px-3 py-1.5 rounded-lg transition-colors active:scale-95 cursor-pointer">
                                Besok 09:00
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <label class="block text-slate-400 text-sm font-semibold mb-2">Durasi Reservasi</label>
                    <div class="flex gap-4">
                        <div class="relative flex-1">
                            <input type="number" name="duration_hours" id="duration_hours" min="0" max="168" value="1" class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-2.5 pr-14 font-medium" required oninput="updateSummary()">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-slate-400 text-sm font-bold">Jam</span>
                            </div>
                        </div>
                        <div class="relative flex-1">
                            <input type="number" name="duration_minutes" id="duration_minutes" min="0" max="59" value="0" step="5" class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-2.5 pr-16 font-medium" required oninput="updateSummary()">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-slate-400 text-sm font-bold">Menit</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2.5">
                        <div class="flex flex-wrap gap-2">
                            <button type="button" onclick="setPresetDuration(0, 30)" class="text-xs bg-slate-900/90 border border-slate-700 hover:border-brand-500 hover:text-brand-400 text-slate-300 px-3 py-1.5 rounded-lg transition-colors active:scale-95 cursor-pointer">30 Menit</button>
                            <button type="button" onclick="setPresetDuration(1, 0)" class="text-xs bg-slate-900/90 border border-slate-700 hover:border-brand-500 hover:text-brand-400 text-slate-300 px-3 py-1.5 rounded-lg transition-colors active:scale-95 cursor-pointer">1 Jam</button>
                            <button type="button" onclick="setPresetDuration(2, 0)" class="text-xs bg-slate-900/90 border border-slate-700 hover:border-brand-500 hover:text-brand-400 text-slate-300 px-3 py-1.5 rounded-lg transition-colors active:scale-95 cursor-pointer">2 Jam</button>
                            <button type="button" onclick="setPresetDuration(5, 0)" class="text-xs bg-slate-900/90 border border-slate-700 hover:border-brand-500 hover:text-brand-400 text-slate-300 px-3 py-1.5 rounded-lg transition-colors active:scale-95 cursor-pointer">5 Jam</button>
                            <button type="button" onclick="setPresetDuration(24, 0)" class="text-xs bg-slate-900/90 border border-slate-700 hover:border-brand-500 hover:text-brand-400 text-slate-300 px-3 py-1.5 rounded-lg transition-colors active:scale-95 cursor-pointer">1 Hari</button>
                        </div>
                    </div>
                </div>
                <hr class="border-slate-700 my-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-slate-400 text-sm font-semibold mb-2">Tipe Parkir</label>
                        <select name="parking_type" id="parking_type_select" class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-2.5 truncate" required>
                            <option value="reguler">Reguler - Rp 4.000/jam</option>
                            <option value="vip">VIP - Rp 6.000/jam</option>
                            <option value="vvip">VVIP - Rp 12.000/jam</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-slate-400 text-sm font-semibold mb-2">Pilih Slot Parkir</label>
                        <select name="slot_id" id="slot_select" class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-2.5 truncate" required>
                            @foreach($slots as $s)
                                <option value="{{ $s->id }}">
                                    Slot {{ $s->kode_slot }} - {{ $s->tipe_kendaraan }} ({{ $s->lantai }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr class="border-slate-700 my-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-slate-300 text-sm font-semibold mb-2">Nama Pengemudi</label>
                        <input type="text" name="name" class="w-full bg-slate-900 border border-slate-700 text-slate-50 placeholder:text-slate-500 placeholder:font-normal text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-2.5" required placeholder="Nama lengkap pengemudi">
                    </div>
                    <div>
                        <label class="block text-slate-300 text-sm font-semibold mb-2">Nomor HP (WhatsApp)</label>
                        <input type="tel" name="phone" class="w-full bg-slate-900 border border-slate-700 text-slate-50 placeholder:text-slate-500 placeholder:font-normal text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-2.5" required placeholder="08xxxxxxxxxx (WhatsApp)">
                    </div>
                </div>
                <div class="mb-5">
                    <label class="block text-slate-300 text-sm font-semibold mb-2">Plat Nomor Kendaraan</label>
                    <input type="text" name="plate" class="w-full bg-slate-900 border border-slate-700 text-slate-50 placeholder:text-slate-500 placeholder:font-normal text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-2.5 uppercase" required placeholder="Contoh: B 1234 ABC">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-slate-400 text-sm font-semibold mb-2">Jenis Kendaraan</label>
                        <select name="vehicle_type" class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-2.5">
                            <option value="Mobil">Mobil</option>
                            <option value="Motor">Motor</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-slate-400 text-sm font-semibold mb-2">Metode Pembayaran</label>
                        <select name="payment_method" class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-2.5">
                            <option value="QRIS">QRIS</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="md:col-span-5 min-w-0 max-w-full">
            <div class="bg-slate-800 border border-slate-700 rounded-xl p-4 sm:p-6 h-full flex flex-col hover:border-slate-600 transition-colors overflow-hidden">
                <h6 class="font-bold text-white mb-6">Payment Summary</h6>
                <p class="text-slate-400 text-sm mb-6 leading-relaxed" id="payment_desc">
                    Pembayaran tagihan parkir dilakukan di muka sesuai dengan durasi yang dipilih. Apabila waktu aktual parkir melebihi durasi reservasi, selisih biaya dapat diselesaikan pada saat proses check-out.
                </p>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-slate-400 text-sm">Tarif Dasar (<span id="tarif_text">Reguler</span>)</span>
                    <span class="text-white text-sm" id="tarif_rate">Rp 4.000/jam</span>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-slate-400 text-sm">Durasi Dipilih</span>
                    <span class="text-white text-sm" id="durasi_text">1 Jam</span>
                </div>
                <hr class="border-slate-700 my-4">
                <div class="flex justify-between items-center mb-6">
                    <span class="font-bold text-white uppercase text-sm">Total Bayar</span>
                    <span class="font-bold text-brand-500 text-2xl" id="total_fee_display">Rp 4.000</span>
                    <input type="hidden" name="total_biaya" id="total_biaya_input" value="4000">
                </div>
                <div class="mt-auto">
                    <button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-3 px-4 rounded-xl transition-colors uppercase text-sm tracking-wide focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 focus:ring-offset-slate-900 cursor-pointer">
                        Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
const durationHours = document.getElementById('duration_hours');
const durationMinutes = document.getElementById('duration_minutes');
const parkingTypeSelect = document.getElementById('parking_type_select');

function updateSummary() {
    let typeName = 'Reguler';
    let rate = 4000;
    if (parkingTypeSelect.value === 'vip') {
        typeName = 'VIP';
        rate = 6000;
    } else if (parkingTypeSelect.value === 'vvip') {
        typeName = 'VVIP';
        rate = 12000;
    }
    let h = parseInt(durationHours.value) || 0;
    let m = parseInt(durationMinutes.value) || 0;
    if (m > 59) {
        h += Math.floor(m / 60);
        m = m % 60;
        durationHours.value = h;
        durationMinutes.value = m;
    }
    if (h === 0 && m === 0) {
        m = 30;
        durationMinutes.value = m;
    }
    let duration = h + (m / 60);
    let durationText = '';
    if (h > 0) durationText += h + ' Jam ';
    if (m > 0) durationText += m + ' Menit';
    let total = Math.round(duration * rate);

    document.getElementById('tarif_text').innerText = typeName;
    document.getElementById('tarif_rate').innerText = 'Rp ' + rate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '/jam';
    document.getElementById('durasi_text').innerText = durationText.trim();
    document.getElementById('total_fee_display').innerText = 'Rp ' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    document.getElementById('total_biaya_input').value = total;
}

function setPresetDuration(h, m) {
    durationHours.value = h;
    durationMinutes.value = m;
    updateSummary();
}

function formatLocalDateTime(d) {
    const pad = n => String(n).padStart(2, '0');
    return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
}

function openDateTimePicker() {
    const input = document.getElementById('expected_entry_time');
    if (input && typeof input.showPicker === 'function') {
        try { input.showPicker(); } catch(e) { input.focus(); }
    } else if (input) {
        input.focus();
    }
}

function setPresetMinutes(mins) {
    const d = new Date();
    d.setMinutes(d.getMinutes() + mins);
    const input = document.getElementById('expected_entry_time');
    if (input) input.value = formatLocalDateTime(d);
}

function setPresetTomorrow(hour) {
    const d = new Date();
    d.setDate(d.getDate() + 1);
    d.setHours(hour, 0, 0, 0);
    const input = document.getElementById('expected_entry_time');
    if (input) input.value = formatLocalDateTime(d);
}

parkingTypeSelect.addEventListener('change', updateSummary);
updateSummary();
</script>
@endsection