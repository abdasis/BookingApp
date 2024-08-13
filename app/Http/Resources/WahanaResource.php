<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Wahana */
class WahanaResource extends JsonResource
{
	public function toArray(Request $request)
	{
		return [
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'id' => $this->id,
			'nama' => $this->nama,
			'deskripsi' => $this->deskripsi,
			'harga_weekday' => $this->harga_weekday,
			'harga_weekend' => $this->harga_weekend,
			'galeries' => $this->galeries,
		];
	}
}
