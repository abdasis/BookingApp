<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WahanaRequest extends FormRequest
{
	public function rules()
	{
		return [
			'nama' => ['required'],
			'deskripsi' => ['nullable'],
			'harga_weekday' => ['required', 'numeric'],
			'harga_weekend' => ['required', 'numeric'],
			'galeries' => ['nullable'],
		];
	}

	public function authorize()
	{
		return true;
	}
}
