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
            $table->date('data_nasc');
            $table->string('genere', 1);
            $table->string('via', 30);
            $table->integer('civico')->unsigned();
            $table->string('citta', 30);
            $table->string('prov', 2);
            $table->string('telefono', 13);
            $table->string('email', 40);
            $table->string('clinico', 20)->references('username')->on('clinico');
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
