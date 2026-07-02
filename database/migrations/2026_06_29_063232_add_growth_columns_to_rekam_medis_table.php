<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rekam_medis', function (Blueprint $table) {
            $table->decimal('berat_badan', 5, 2)->nullable()->after('catatan_dokter');
            $table->decimal('tinggi_badan', 5, 2)->nullable()->after('berat_badan');
            $table->decimal('lingkar_kepala', 5, 2)->nullable()->after('tinggi_badan');
            $table->decimal('suhu', 4, 1)->nullable()->after('lingkar_kepala');
            $table->string('tekanan_darah')->nullable()->after('suhu');
        });
    }

    public function down(): void
    {
        Schema::table('rekam_medis', function (Blueprint $table) {
            $table->dropColumn([
                'berat_badan',
                'tinggi_badan',
                'lingkar_kepala',
                'suhu',
                'tekanan_darah',
            ]);
        });
    }
};