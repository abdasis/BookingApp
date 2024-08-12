<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class roomDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'room_details';
    protected $fillable = [
        'idRoom',
        'gambar'
    ];
}
