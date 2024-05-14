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
        Schema::create('faq', function (Blueprint $table) {
            $table->string('domanda', 250);
            $table->string('risposta', 1000);
            $table->id('id');
        });
    }

    /**
     * Reverse the migrations.
     * @return void  
     */
    public function down(): void
    {
        Schema::dropIfExists('faq');
    }
};
