<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('reservations')) {
            Schema::create('reservations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('parking_slot_id')->constrained('parking_slots')->cascadeOnDelete();
                $table->string('nama_pengemudi');
                $table->string('nomor_telepon');
                $table->string('plat_nomor');
                $table->string('jenis_kendaraan');
                $table->string('metode_pembayaran');
                $table->integer('total_biaya');
                $table->string('status')->default('Aktif');
                $table->dateTime('waktu_masuk')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};

