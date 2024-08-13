<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wahana extends Model
{
	use HasFactory;

	protected $fillable = [
		'nama',
		'deskripsi',
		'harga_weekday',
		'harga_weekend',
		'status',
		'galeries',
	];
}
