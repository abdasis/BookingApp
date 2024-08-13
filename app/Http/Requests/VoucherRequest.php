<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoucherRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'code' => ['required', Rule::unique('vouchers', 'code')->ignore($this->voucher->id ?? null)],
			'description' => ['nullable'],
			'amount' => ['required', 'numeric'],
			'status' => ['required'],
			'expired_date' => ['required', 'date'],
			'start_date' => ['required', 'date'],
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
