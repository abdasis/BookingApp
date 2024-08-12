<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('roomId');
            $table->integer('userId');
            $table->string('NamaBooking');
            $table->string('Email');
            $table->string('JenisIdentitas');
            $table->string('NoIdentitas');
            $table->enum('Gender', ['L','P']);
            $table->integer('hp');
            $table->dateTime('checkIn');
            $table->dateTime('checkOut');
            $table->integer('jumlahTamu');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
