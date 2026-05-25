<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asesmen', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kunjungan_id')->constrained('kunjungan')->onDelete('cascade');

            $table->text('keluhan_utama');
            $table->string('tekanan_darah', 20)->nullable();
            $table->decimal('suhu_tubuh', 4, 1)->nullable();
            $table->decimal('berat_badan', 5, 1)->nullable();
            $table->text('diagnosis_awal')->nullable();
            $table->text('tindakan_terapi')->nullable();
            $table->text('catatan_dokter')->nullable();

            $table->timestamps();

            $table->unique('kunjungan_id');
            $table->index('kunjungan_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asesmen');
    }
};
