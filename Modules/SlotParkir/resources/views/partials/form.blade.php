<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
    <div>
        <label for="kode_slot" class="block text-sm font-semibold text-slate-300 mb-2">
            Kode Slot Parkir <span class="text-red-400">*</span>
        </label>
        <input
            type="text"
            id="kode_slot"
            name="kode_slot"
            value="{{ old('kode_slot', $slotParkir?->kode_slot) }}"
            placeholder="Contoh: A-01, B-02"
            required
            class="w-full bg-slate-900 border @error('kode_slot') border-red-500 @else border-slate-700 @enderror text-slate-50 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3 uppercase font-mono"
        >
        @error('kode_slot')
            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="lantai" class="block text-sm font-semibold text-slate-300 mb-2">
            Lokasi Lantai / Zona <span class="text-red-400">*</span>
        </label>
        <select
            id="lantai"
            name="lantai"
            required
            class="w-full bg-slate-900 border @error('lantai') border-red-500 @else border-slate-700 @enderror text-slate-50 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3"
        >
            @foreach (['Lantai 1', 'Lantai 2', 'Lantai 3', 'Basement'] as $opsiLantai)
                <option value="{{ $opsiLantai }}" @selected(old('lantai', $slotParkir?->lantai ?? 'Lantai 1') === $opsiLantai)>
                    {{ $opsiLantai }}
                </option>
            @endforeach
        </select>
        @error('lantai')
            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
    <div>
        <label for="tipe_kendaraan" class="block text-sm font-semibold text-slate-300 mb-2">
            Tipe Kendaraan <span class="text-red-400">*</span>
        </label>
        <select
            id="tipe_kendaraan"
            name="tipe_kendaraan"
            required
            class="w-full bg-slate-900 border @error('tipe_kendaraan') border-red-500 @else border-slate-700 @enderror text-slate-50 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3"
        >
            @foreach (['Mobil', 'Motor'] as $tipe)
                <option value="{{ $tipe }}" @selected(old('tipe_kendaraan', $slotParkir?->tipe_kendaraan ?? 'Mobil') === $tipe)>
                    {{ $tipe }}
                </option>
            @endforeach
        </select>
        @error('tipe_kendaraan')
            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="tarif_per_jam" class="block text-sm font-semibold text-slate-300 mb-2">
            Tarif per Jam (Rp) <span class="text-red-400">*</span>
        </label>
        <input
            type="number"
            id="tarif_per_jam"
            name="tarif_per_jam"
            value="{{ old('tarif_per_jam', $slotParkir?->tarif_per_jam ?? 4000) }}"
            min="1000"
            step="500"
            placeholder="Contoh: 4000"
            required
            class="w-full bg-slate-900 border @error('tarif_per_jam') border-red-500 @else border-slate-700 @enderror text-slate-50 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3"
        >
        @error('tarif_per_jam')
            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="status" class="block text-sm font-semibold text-slate-300 mb-2">
            Status Slot <span class="text-red-400">*</span>
        </label>
        <select
            id="status"
            name="status"
            required
            class="w-full bg-slate-900 border @error('status') border-red-500 @else border-slate-700 @enderror text-slate-50 text-sm rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 block p-3"
        >
            @foreach (['Tersedia', 'Terisi', 'Booking'] as $st)
                <option value="{{ $st }}" @selected(old('status', $slotParkir?->status ?? 'Tersedia') === $st)>
                    {{ $st }}
                </option>
            @endforeach
        </select>
        @error('status')
            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>
</div>

