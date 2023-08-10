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
        Schema::create('penarikan_anggaran', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_belanja');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });

        Schema::create('penarikan_anggaran_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penarikan_anggaran_id')->constrained('penarikan_anggaran')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('triwulan_id')->constrained('triwulans');
            $table->bigInteger('target_belanja');
            $table->bigInteger('realisasi_belanja');
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
        Schema::dropIfExists('penarikan_dana_anggarans');
        Schema::dropIfExists('penarikan_dana_anggaran_details');
    }
};
