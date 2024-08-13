<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('nama',100)->nullable();
            $table->string('deskripsi', 255)->nullable();
            $table->integer('qty')->nullable();
            $table->time('checkout')->nullable();
            $table->string('tarifWd')->nullable();
            $table->string('tarifWe')->nullable();
            $table->string('facilities')->nullable();
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
