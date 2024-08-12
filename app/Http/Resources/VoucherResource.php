<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Voucher */
class VoucherResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'id' => $this->id,
			'code' => $this->code,
			'description' => $this->description,
			'amount' => $this->amount,
			'status' => $this->status,
			'expired_date' => $this->expired_date,
			'start_date' => $this->start_date,
		];
	}
}
