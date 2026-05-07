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
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->string('ktp_kia')->nullable();
            $table->string('surat_sehat')->nullable();
            $table->string('kartu_bpjs')->nullable();
            $table->string('surat_balasan')->nullable();
            $table->string('buku_tabungan')->nullable();
            $table->boolean('lengkap')->default(false);
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};
