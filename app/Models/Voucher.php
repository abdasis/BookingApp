<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
	use HasFactory;

	protected $fillable = [
		'code',
		'description',
		'amount',
		'status',
		'expired_date',
		'start_date',
	];

	protected $casts = [
		'expired_date' => 'date',
		'start_date' => 'date',
	];
}
