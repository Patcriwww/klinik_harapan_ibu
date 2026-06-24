<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_konsultasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tenaga_medis_id')->constrained('tenaga_medis')->onDelete('cascade');
            $table->foreignId('jadwal_praktik_id')->constrained('jadwal_praktiks')->onDelete('cascade');
        
            $table->date('tanggal_konsultasi');
            $table->time('jam_konsultasi');
            $table->text('keluhan')->nullable();
        
            $table->string('nomor_antrian')->nullable();
            $table->string('kode_booking')->nullable();
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'batal'])->default('menunggu');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_konsultasis');
    }
};
