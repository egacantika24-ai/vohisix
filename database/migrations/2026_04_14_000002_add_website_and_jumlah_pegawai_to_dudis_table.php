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
        Schema::table('dudis', function (Blueprint $table) {
            if (!Schema::hasColumn('dudis', 'website')) {
                $table->string('website')->nullable()->after('email');
            }
            if (!Schema::hasColumn('dudis', 'jumlah_pegawai')) {
                $table->string('jumlah_pegawai')->nullable()->after('website');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dudis', function (Blueprint $table) {
            if (Schema::hasColumn('dudis', 'jumlah_pegawai')) {
                $table->dropColumn('jumlah_pegawai');
            }
            if (Schema::hasColumn('dudis', 'website')) {
                $table->dropColumn('website');
            }
        });
    }
};
