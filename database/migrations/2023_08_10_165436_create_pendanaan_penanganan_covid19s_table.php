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
        Schema::create('pendanaan_penanganan_covid19s', function (Blueprint $table) {
            $table->id();
            $table->string('fokus');
            $table->string('program');
            $table->bigInteger('target');
            $table->bigInteger('realisasi');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('pendanaan_penanganan_covid19s');
    }
};
