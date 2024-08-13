<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'roomtype', 'nama', 'deskripsi', 'qty', 'checkout', 'tarifWd', 'tarifWe', 'Fasilitas', 'status', 'imgPreview'
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'Fasilitas' => 'json'
    ];

    public function roomtypes()
    {
        return $this->hasOne(Roomtype::class, 'id', 'roomtype');
    }

    public function fotoroom()
    {
        return $this->hasMany(RoomDetail::class, 'idRoom', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'roomId', 'id');
    }
}
