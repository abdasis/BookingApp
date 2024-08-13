<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory,SoftDeletes;
protected $table = 'bookings';

protected $fillable = [
    'roomId',
    'userId',
    'NamaBooking',
    'Email',
    'JenisIdentitas',
    'NoIdentitas',
    'Gender',
    'hp',
    'checkIn',
    'checkOut',
    'jumlahTamu',
    'Total',
    'Status',
    'isOnline',
];

protected $dates = [
    'checkIn',
    'checkOut',
    'deleted_at'
];

protected $casts = [
    'Gender' => 'string'
];
    public function roomtypes()
    {
        return $this->hasOne(Room::class, 'id', 'roomId');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

}
