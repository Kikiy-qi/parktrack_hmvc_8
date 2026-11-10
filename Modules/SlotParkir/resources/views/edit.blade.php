@extends('layouts.app')

@section('title', 'Edit Slot Parkir - ParkTrack')

@section('content')
<div class="max-w-2xl mx-auto mb-12">
    <div class="mb-4">
        <a href="{{ route('slot-parkir.index') }}" class="text-sm text-slate-400 hover:text-white inline-flex items-center gap-1.5">
            <i class="bi bi-arrow-left"></i> Kembali ke daftar slot parkir
        </a>
        <h2 class="text-2xl font-bold text-white mt-2 flex items-center">
            <i class="bi bi-pencil-square text-brand-500 mr-2.5"></i>Edit Slot Parkir: {{ $slotParkir->kode_slot }}
        </h2>
    </div>

    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-lg">
        <form action="{{ route('slot-parkir.update', $slotParkir) }}" method="POST">
            @csrf
            @method('PUT')
            @include('slotparkir::partials.form', ['slotParkir' => $slotParkir])

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-700">
                <a href="{{ route('slot-parkir.index') }}" class="border border-slate-600 text-slate-300 hover:text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors">
                    Batal
                </a>
                <button type="submit" class="bg-brand-500 hover:bg-brand-600 text-white font-bold px-6 py-2.5 rounded-xl text-sm transition-colors cursor-pointer shadow-lg shadow-brand-500/20">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

