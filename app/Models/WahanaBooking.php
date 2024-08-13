<?php

namespace App\Models;

use App\Wahana;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WahanaBooking extends Model
{
	use SoftDeletes, HasFactory;

	protected $fillable = [
		'wahana_id',
		'user_id',
		'nomor_identitas',
		'gender',
		'telepon',
		'tanggal_booking',
		'discount',
		'voucher_id',
		'jumlah_discount',
		'total',
		'status',
		'jenis_booking'
	];

	protected $casts = [
		'tanggal_booking' => 'date',
	];

	public function wahana(): BelongsTo
	{
		return $this->belongsTo(Wahana::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function voucher(): BelongsTo
	{
		return $this->belongsTo(Voucher::class);
	}
}
