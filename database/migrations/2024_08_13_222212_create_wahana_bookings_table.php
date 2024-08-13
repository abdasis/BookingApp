<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('wahana_bookings', function (Blueprint $table) {
			$table->id();
			$table->foreignId('wahana_id');
			$table->foreignId('user_id');
			$table->string('nomor_identitas');
			$table->string('gender');
			$table->string('telepon');
			$table->date('tanggal_booking');
			$table->foreignId('voucher_id')->nullable();
			$table->decimal('jumlah_discount', 20)->nullable();
			$table->decimal('total', 20);
			$table->enum('status', ['pending', 'paid', 'expired', 'cancelled'])->default('pending');
			$table->enum('jenis_booking', ['online', 'offline'])->default('online');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('wahana_bookings');
	}
};
