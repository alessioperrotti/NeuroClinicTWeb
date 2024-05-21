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
        Schema::create('user', function (Blueprint $table) {
            $table->string('username', 20);
            $table->string('password');
            $table->string('usertype', 1);   //A per admin, P per paziente e C per clinico
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
