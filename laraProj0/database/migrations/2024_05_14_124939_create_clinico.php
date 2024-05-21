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
        Schema::create('clinico', function (Blueprint $table) {
            $table->string('username', 20)->references('username')->on('user');
            $table->string('nome', 30);
            $table->string('cognome', 30);
            $table->date('dataNasc');
            $table->string('ruolo', 20);
            $table->string('specializ', 30);
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('clinico');
    }
};
