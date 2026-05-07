<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->timestamps();
        });

        DB::table('locations')->insert([
            ['provinsi' => 'Jawa Barat', 'kabupaten' => 'Bandung'],
            ['provinsi' => 'Jawa Tengah', 'kabupaten' => 'Kota Semarang'],
            ['provinsi' => 'Jawa Tengah', 'kabupaten' => 'Kota Solo'],
            ['provinsi' => 'Jawa Timur', 'kabupaten' => 'Kota Malang'],
            ['provinsi' => 'Jawa Timur', 'kabupaten' => 'Kota Surabaya'],
            ['provinsi' => 'Jawa Timur', 'kabupaten' => 'Kota Batu'],
            ['provinsi' => 'Jawa Timur', 'kabupaten' => 'Kota Kediri'],
            ['provinsi' => 'Jawa Timur', 'kabupaten' => 'Kota Blitar'],
            ['provinsi' => 'DKI Jakarta', 'kabupaten' => 'Jakarta Pusat'],
            ['provinsi' => 'Banten', 'kabupaten' => 'Kota Tangerang'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
