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
        Schema::create('pendapatans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_pendapatan');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });

        Schema::create('pendapatan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendapatan_id')->constrained('pendapatans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('triwulan_id')->constrained('triwulans');
            $table->bigInteger('target_pendapatan');
            $table->bigInteger('realisasi_pendapatan');
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
        Schema::dropIfExists('pendapatans');
        Schema::dropIfExists('pendapatan_details');
    }
};
