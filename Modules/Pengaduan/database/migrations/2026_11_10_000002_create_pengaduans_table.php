<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('pengaduans')) {
            Schema::create('pengaduans', function (Blueprint $table) {
                $table->id();
                $table->string('nama_pengemudi');
                $table->string('kontak');
                $table->string('plat_nomor');
                $table->string('kategori');
                $table->dateTime('jadwal_baru')->nullable();
                $table->text('deskripsi');
                $table->string('file_bukti');
                $table->string('nama_berkas')->nullable();
                $table->string('status')->default('Menunggu');
                $table->timestamps();
            });
        } elseif (! Schema::hasColumn('pengaduans', 'nama_berkas')) {
            Schema::table('pengaduans', function (Blueprint $table) {
                $table->string('nama_berkas')->nullable()->after('file_bukti');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};

