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
        Schema::create('permasalahan_pbjs', function (Blueprint $table) {
            $table->id();
            $table->string('permasalahan');
            $table->text('penyebab');
            $table->string('rekomendasi')->nullable();
            $table->foreignId('triwulan_id')->constrained('triwulans');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('tim_tepra_user_id')->nullable()->constrained('users');
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
        Schema::dropIfExists('permasalahan_pbjs');
    }
};
