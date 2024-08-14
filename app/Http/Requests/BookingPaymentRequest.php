<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingPaymentRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'wahana_booking_id' => ['required', 'exists:wahana_bookings'],
			'bukti_transfer' => ['required'],
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
