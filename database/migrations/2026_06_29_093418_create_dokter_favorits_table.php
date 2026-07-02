<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokter_favorits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tenaga_medis_id')->constrained('tenaga_medis')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'tenaga_medis_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokter_favorits');
    }
};