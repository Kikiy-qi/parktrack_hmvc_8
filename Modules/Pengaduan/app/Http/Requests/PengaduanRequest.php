<?php

namespace Modules\Pengaduan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PengaduanRequest extends FormRequest
{
    public function rules(): array
    {
        $pengaduan = $this->route('pengaduan');

        return [
            'nama_pengemudi' => ['required', 'string', 'max:255'],
            'kontak' => ['required', 'string', 'max:100'],
            'plat_nomor' => ['required', 'string', 'max:20'],
            'kategori' => ['required', Rule::in(['Reschedule Jadwal', 'Masalah Slot', 'Lainnya'])],
            'jadwal_baru' => ['nullable', 'date'],
            'deskripsi' => ['required', 'string'],
            'status' => ['nullable', Rule::in(['Menunggu', 'Diproses', 'Selesai'])],
            'file_bukti' => [$pengaduan ? 'nullable' : 'required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_pengemudi.required' => 'Nama pengemudi wajib diisi.',
            'kontak.required' => 'Nomor telepon atau email kontak wajib diisi.',
            'plat_nomor.required' => 'Plat nomor kendaraan wajib diisi.',
            'kategori.required' => 'Kategori pengaduan wajib dipilih.',
            'kategori.in' => 'Kategori pengaduan tidak valid.',
            'jadwal_baru.date' => 'Format jadwal baru tidak valid.',
            'deskripsi.required' => 'Deskripsi pengaduan wajib diisi.',
            'status.in' => 'Status penanganan harus Menunggu, Diproses, atau Selesai.',
            'file_bukti.required' => 'Berkas bukti tiket atau kendala wajib diunggah.',
            'file_bukti.mimes' => 'Berkas bukti harus berformat jpg, jpeg, png, atau pdf.',
            'file_bukti.max' => 'Ukuran berkas maksimal 2 MB.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

