<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pasien_id')->constrained('pasien')->onDelete('cascade');

            $table->date('tanggal_kunjungan');
            $table->string('poli_tujuan');
            $table->string('dokter');
            $table->enum('jenis_pembayaran', ['Umum', 'BPJS', 'Asuransi', 'Gratis']);
            $table->enum('status', ['terdaftar', 'sudah_asesmen', 'batal'])->default('terdaftar');

            $table->timestamps();

            $table->index('pasien_id');
            $table->index('tanggal_kunjungan');
            $table->index('dokter');
            $table->index('poli_tujuan');
            $table->index('status');
            $table->index(['pasien_id', 'tanggal_kunjungan']);
            $table->index(['poli_tujuan', 'tanggal_kunjungan']);
            $table->index(['dokter', 'tanggal_kunjungan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};
