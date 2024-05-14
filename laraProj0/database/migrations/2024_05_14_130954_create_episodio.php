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
        Schema::create('episodio', function (Blueprint $table) {
            $table->id('id');
            $table->date('data');
            $table->time('ora');
            $table->integer('durata')->unsigned();
            $table->integer('intensita')->unsigned();
            $table->string('paziente', 20)->references('username')->on('paziente');
            $table->string('nome', 30)->references('nome')->on('distmotorio');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('episodio');
    }
};
