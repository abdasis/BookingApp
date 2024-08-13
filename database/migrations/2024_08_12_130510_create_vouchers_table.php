<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('vouchers', function (Blueprint $table) {
			$table->id();
			$table->string('code');
			$table->text('description')->nullable();
			$table->decimal('amount', 20,2);
			$table->enum('status', ['active', 'expired'])->default('active');
			$table->date('start_date');
			$table->date('expired_date');
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('vouchers');
	}
};
