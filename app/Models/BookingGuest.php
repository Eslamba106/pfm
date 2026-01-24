<?php

namespace App\Models;

use Dba\Connection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingGuest extends Model
{
    use HasFactory;

        protected $fillable = [
        'booking_id',
        'room_id',
        'guest_type',
        'full_name',
        'gender',
        'dob',
        'age',
        'id_type',
        'id_file',
    ];


    protected $connection = 'tenant';
}
