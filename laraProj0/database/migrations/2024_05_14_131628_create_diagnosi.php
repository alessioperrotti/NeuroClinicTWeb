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
            $table->string('paziente', 20)->references('username')->on('paziente');
            $table->string('disturbo', 20)->references('nome', 30)->on('distmotorio');
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
