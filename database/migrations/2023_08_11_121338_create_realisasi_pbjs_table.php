<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi_pbjs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('triwulan_id')->constrained('triwulans');
            $table->string('tahapan');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
        Schema::create('realisasi_pbj_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('realisasi_pbj_id')->constrained('realisasi_pbjs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('jenis_barang_jasa_id')->constrained('jenis_barang_jasas');
            $table->integer('paket');
            $table->bigInteger('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realisasi_pbj_details');
        Schema::dropIfExists('realisasi_pbjs');
    }
};
