<?php

namespace Database\Factories;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VoucherFactory extends Factory
{
	protected $model = Voucher::class;

	public function definition(): array
	{
		return [
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			'code' => $this->faker->word(),
			'description' => $this->faker->text(),
			'amount' => $this->faker->randomFloat(),
			'status' => $this->faker->word(),
			'expired_date' => Carbon::now(),
			'start_date' => Carbon::now(),
		];
	}
}
