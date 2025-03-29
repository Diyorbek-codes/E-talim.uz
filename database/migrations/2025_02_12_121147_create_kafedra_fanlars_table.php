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
        Schema::create('kafedra_fanlars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fanlar_id');
            $table->unsignedBigInteger('guruh_id');
            $table->unsignedBigInteger('uquv_yili_ohtm_id');
            $table->string('soat');
            $table->boolean('oraliq');
            $table->boolean('yakuniy');

            $table->foreign('fanlar_id')->references('id')->on('fanlars');
            $table->foreign('guruh_id')->references('id')->on('guruhs');
            $table->foreign('uquv_yili_ohtm_id')->references('id')->on('uquv_yili_ohtms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kafedra_fanlars');
    }
};
