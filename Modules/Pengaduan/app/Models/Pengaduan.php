<?php

namespace Modules\Pengaduan\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    protected $fillable = [
        'nama_pengemudi',
        'kontak',
        'plat_nomor',
        'kategori',
        'jadwal_baru',
        'deskripsi',
        'file_bukti',
        'nama_berkas',
        'status',
    ];

    protected $appends = [
        'file_bukti_url',
        'display_nama_berkas',
    ];

    protected function fileBuktiUrl(): Attribute
    {
        return Attribute::get(fn (): ?string => $this->file_bukti ? asset('storage/'.$this->file_bukti) : null);
    }

    protected function displayNamaBerkas(): Attribute
    {
        return Attribute::get(fn (): ?string => $this->nama_berkas ?: ($this->file_bukti ? basename($this->file_bukti) : null));
    }
}

