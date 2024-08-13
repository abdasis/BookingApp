<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Voucher;
use App\Models\WahanaBooking;
use App\Wahana;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class WahanaBookingFactory extends Factory
{
	protected $model = WahanaBooking::class;

	public function definition(): array
	{
		return [
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			'nomor_identitas' => $this->faker->word(),
			'gender' => $this->faker->word(),
			'telepon' => $this->faker->word(),
			'tanggal_booking' => Carbon::now(),
			'discount' => $this->faker->word(),
			'jumlah_discount' => $this->faker->randomFloat(),
			'total' => $this->faker->randomFloat(),

			'wahana_id' => Wahana::factory(),
			'user_id' => User::factory(),
			'voucher_id' => Voucher::factory(),
		];
	}
}
