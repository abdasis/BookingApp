<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WahanaBookingRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'wahana_id' => ['required',],
			'user_id' => ['nullable'],
			'nomor_identitas' => ['required'],
			'gender' => ['nullable'],
			'telepon' => ['required'],
			'tanggal_booking' => ['required', 'date'],
			'discount' => ['nullable'],
			'voucher_id' => ['nullable',],
			'jumlah_discount' => ['nullable', 'numeric'],
			'total' => ['nullable', 'numeric'],
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
