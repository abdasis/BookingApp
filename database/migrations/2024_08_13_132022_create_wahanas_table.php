<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('wahanas', function (Blueprint $table) {
			$table->id();
			$table->string('nama');
			$table->text('deskripsi')->nullable();
			$table->decimal('harga_weekday', 20);
			$table->decimal('harga_weekend', 20);
			$table->text('galeries');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('wahanas');
	}
};
