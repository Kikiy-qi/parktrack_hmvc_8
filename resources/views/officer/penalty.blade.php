@extends('layouts.app')

@section('title', 'Catat Pelanggaran - ParkTrack')

@section('content')
<div class="flex justify-center mb-12">
    <div class="w-full max-w-3xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-bold text-white text-2xl flex items-center">
                <i class="bi bi-shield-exclamation text-red-500 mr-3"></i>Catat Pelanggaran (Denda)
            </h2>
            <a href="{{ route('officer.index') }}" class="border border-slate-600 text-slate-400 hover:text-white hover:border-slate-500 rounded-lg px-4 py-2 text-sm transition-colors">
                Kembali
            </a>
        </div>

        @if(!empty($success))
            <div class="bg-green-500/10 border border-green-500/50 text-green-500 px-4 py-3 rounded-xl mb-6 flex items-center">
                <i class="bi bi-check-circle-fill mr-3"></i> {{ $success }}
            </div>
        @endif

        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-8 hover:border-slate-600 transition-colors shadow-lg">
            <form action="{{ route('officer.penalty') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-slate-400 text-sm font-semibold mb-2">Plat Nomor Pelanggar</label>
                        <input type="text" name="plate" class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-3 uppercase font-mono" required placeholder="B 1234 CD">
                    </div>
                    <div>
                        <label class="block text-slate-400 text-sm font-semibold mb-2">Jenis Pelanggaran</label>
                        <select id="violation_template" class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-3 mb-3" onchange="applyTemplate()">
                            <option value="">-- Pilih Template (Bisa ketik sendiri) --</option>
                            <option value="Melebihi Batas Waktu Reservasi|30000">Melebihi Batas Waktu Reservasi (Rp 30.000)</option>
                            <option value="Parkir Tidak Sesuai Slot|50000">Parkir Tidak Sesuai Slot (Rp 50.000)</option>
                            <option value="Parkir Sembarangan (Menutupi Jalan)|100000">Parkir Sembarangan (Rp 100.000)</option>
                            <option value="Menghilangkan Tiket / Kartu|50000">Menghilangkan Tiket / Kartu (Rp 50.000)</option>
                        </select>
                        <input type="text" name="violation_type" id="violation_type" class="w-full bg-slate-900/50 border border-slate-700 text-slate-50 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-3" required placeholder="Atau ketik jenis pelanggaran...">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-slate-400 text-sm font-semibold mb-2">Keterangan Tambahan</label>
                    <textarea name="description" rows="3" class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-3" required placeholder="Jelaskan detail pelanggaran..."></textarea>
                </div>

                <div class="mb-8">
                    <label class="block text-slate-400 text-sm font-semibold mb-2">Jumlah Denda (Rp)</label>
                    <input type="number" name="amount" id="amount" class="w-full bg-slate-900/50 border border-slate-700 text-slate-50 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-3" required placeholder="Contoh: 50000">
                </div>

                <div class="text-right border-t border-slate-700 pt-6">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-8 rounded-xl transition-colors shadow">Simpan Denda</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function applyTemplate() {
    const template = document.getElementById('violation_template').value;
    const typeInput = document.getElementById('violation_type');
    const amountInput = document.getElementById('amount');
    if (template) {
        const parts = template.split('|');
        typeInput.value = parts[0];
        amountInput.value = parts[1];
    } else {
        typeInput.value = '';
        amountInput.value = '';
    }
}
</script>
@endsection
