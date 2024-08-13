<?php

namespace Database\Factories;

use App\Wahana;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class WahanaFactory extends Factory
{
	protected $model = Wahana::class;

	public function definition()
	{
		return [
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			'nama' => $this->faker->word(),
			'deskripsi' => $this->faker->word(),
			'harga_weekday' => $this->faker->randomFloat(),
			'harga_weekend' => $this->faker->randomFloat(),
			'status' => $this->faker->word(),
			'galeries' => $this->faker->word(),
		];
	}
}
