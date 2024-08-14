<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\BookingPayment */
class BookingPaymentResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'id' => $this->id,
			'bukti_transfer' => $this->bukti_transfer,

			'wahana_booking_id' => $this->wahana_booking_id,

			'wahanaBooking' => new WahanaBookingResource($this->whenLoaded('wahanaBooking')),
		];
	}
}
