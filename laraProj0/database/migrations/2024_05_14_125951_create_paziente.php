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
        Schema::create('paziente', function (Blueprint $table) {
            $table->string('username', 20)->references('username')->on('user');
            $table->string('nome', 30);
            $table->string('cognome', 30);
            $table->date('dataNasc');
            $table->string('genere', 1);
            $table->string('via', 30);
            $table->string('civico', 5);
            $table->string('citta', 30);
            $table->string('prov', 2);
            $table->string('telefono', 13);
            $table->string('email', 40);
            $table->string('clinico', 20);
            $table->foreign('clinico')->references('username')->on('clinico')->onDelete('set null');
            $table->boolean('terCambiata'); // true se la terapia è stata cambiata e non ancora visualizzata
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('paziente');
    }
};
