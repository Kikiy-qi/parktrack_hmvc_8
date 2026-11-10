<?php

namespace Modules\SlotParkir\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SlotParkirRequest extends FormRequest
{
    public function rules(): array
    {
        $slotParkir = $this->route('slotParkir');

        return [
            'kode_slot' => [
                'required',
                'string',
                'max:20',
                Rule::unique('parking_slots', 'kode_slot')->ignore($slotParkir?->id),
            ],
            'lantai' => ['required', 'string', 'max:100'],
            'tipe_kendaraan' => ['required', Rule::in(['Mobil', 'Motor'])],
            'tarif_per_jam' => ['required', 'integer', 'min:1000'],
            'status' => ['required', Rule::in(['Tersedia', 'Terisi', 'Booking'])],
        ];
    }

    public function messages(): array
    {
        return [
            'kode_slot.required' => 'Kode slot wajib diisi.',
            'kode_slot.unique' => 'Kode slot ini sudah terdaftar.',
            'lantai.required' => 'Lokasi lantai wajib diisi.',
            'tipe_kendaraan.required' => 'Tipe kendaraan wajib dipilih.',
            'tipe_kendaraan.in' => 'Tipe kendaraan harus Mobil atau Motor.',
            'tarif_per_jam.required' => 'Tarif per jam wajib diisi.',
            'tarif_per_jam.integer' => 'Tarif per jam harus berupa angka.',
            'tarif_per_jam.min' => 'Tarif per jam minimal Rp 1.000.',
            'status.required' => 'Status slot wajib dipilih.',
            'status.in' => 'Status slot harus Tersedia, Terisi, atau Booking.',
        ];
    }

    public function authorize(): bool
    {
        return $this->user()?->isOfficer() ?? false;
    }
}

