<?php

namespace Database\Factories;

use App\Models\BookingPayment;
use App\Models\WahanaBooking;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BookingPaymentFactory extends Factory
{
	protected $model = BookingPayment::class;

	public function definition(): array
	{
		return [
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			'bukti_transfer' => $this->faker->word(),

			'wahana_booking_id' => WahanaBooking::factory(),
		];
	}
}
