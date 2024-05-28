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
        Schema::create('diagnosi', function (Blueprint $table) {
            $table->id('id');
            $table->string('paziente', 20)->references('username')->on('paziente');
            // cambiare i vincoli di integrità con id disturbo
            $table->string('disturbo', 30)->references('nome', 30)->on('distmotorio');
            $table->date('data');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosi');
    }
};
