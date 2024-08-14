<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingPayment extends Model
{
	use SoftDeletes, HasFactory;

	protected $fillable = [
		'wahana_booking_id',
		'bukti_transfer',
	];

	public function wahanaBooking(): BelongsTo
	{
		return $this->belongsTo(WahanaBooking::class);
	}
}
