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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_konsultasi_id');

            $table->string('invoice_no')->unique();

            $table->decimal('nominal', 15, 2);

            $table->enum('metode', [
                'QRIS',
                'Transfer Bank',
                'E-Wallet'
            ]);

            $table->string('bukti_bayar')->nullable();

            $table->enum('status', [
                'pending',
                'menunggu_verifikasi',
                'dibayar',
                'ditolak'
            ])->default('pending');

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
