<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(): void
    {
        Schema::create('prescrizione', function (Blueprint $table) {
            $table->id();
            $table->string('freq', 40);
            $table->integer('terapia')->references('id')->on('terapia');
            $table->integer('farmaco')->references('id')->on('farmaco');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('prescrizione');
    }
};
