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
            // Only add columns that don't exist yet
            if (!Schema::hasColumn('dudis', 'logo')) {
                $table->string('logo')->nullable()->after('deskripsi');
            }
            if (!Schema::hasColumn('dudis', 'pembimbing_dudi')) {
                $table->string('pembimbing_dudi')->nullable()->after('logo');
            }
            if (!Schema::hasColumn('dudis', 'jam_masuk')) {
                $table->string('jam_masuk')->nullable()->after('pembimbing_dudi');
            }
            if (!Schema::hasColumn('dudis', 'jam_pulang')) {
                $table->string('jam_pulang')->nullable()->after('jam_masuk');
            }
            if (!Schema::hasColumn('dudis', 'kota')) {
                $table->string('kota')->nullable()->after('jam_pulang');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dudis', function (Blueprint $table) {
            $table->dropColumn(['logo', 'pembimbing_dudi', 'jam_masuk', 'jam_pulang', 'kota']);
        });
    }
};

