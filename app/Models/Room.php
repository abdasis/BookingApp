<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
        'nama','deskripsi','qty','checkout','tarifWd','tarifWe','Fasilitas'
    ];
    protected $dates = ['deleted_at'];
}
