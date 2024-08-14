<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('booking_payments', function (Blueprint $table) {
			$table->id();
			$table->foreignId('wahana_booking_id');
			$table->text('bukti_transfer');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('booking_payments');
	}
};
