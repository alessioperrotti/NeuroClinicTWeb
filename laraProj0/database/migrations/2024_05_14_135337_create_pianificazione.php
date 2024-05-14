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
        Schema::create('pianificazione', function (Blueprint $table) {
            $table->id('ID');
            $table->string('freq', 40);
            $table->integer('terapia')->references('id')->on('terapia');
            $table->integer('attivita')->references('id')->on('attivita');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('pianificazione');
    }
};
