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
        Schema::create('messaggio', function (Blueprint $table) {
            $table->id('id');
            $table->timestamps();
            $table->string('paziente', 20)->references('username')->on('paziente');
            $table->string('clinico', 20)->references('username')->on('clinico');
            $table->string('contenuto', 1000);
            $table->tinyInteger('letto'); // per bool
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('messaggio');
    }
};
