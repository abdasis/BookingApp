<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\WahanaBooking */
class WahanaBookingResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'id' => $this->id,
			'nomor_identitas' => $this->nomor_identitas,
			'gender' => $this->gender,
			'telepon' => $this->telepon,
			'tanggal_booking' => $this->tanggal_booking,
			'discount' => $this->discount,
			'jumlah_discount' => $this->jumlah_discount,
			'total' => $this->total,

			'wahana_id' => $this->wahana_id,
			'user_id' => $this->user_id,
			'voucher_id' => $this->voucher_id,

			'wahana' => new WahanaResource($this->whenLoaded('wahana')),
			'voucher' => new VoucherResource($this->whenLoaded('voucher')),
		];
	}
}
