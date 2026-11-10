<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('parking_slots')) {
            Schema::create('parking_slots', function (Blueprint $table) {
                $table->id();
                $table->string('kode_slot')->unique();
                $table->string('lantai');
                $table->string('tipe_kendaraan');
                $table->unsignedInteger('tarif_per_jam');
                $table->string('status')->default('Tersedia');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('parking_slots');
    }
};
