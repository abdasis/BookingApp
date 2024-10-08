<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fasilitas extends Model
{
	use SoftDeletes;

	protected $table = 'fasilitas';
	protected $fillable = [
		'id',
		'nama'
	];

}
