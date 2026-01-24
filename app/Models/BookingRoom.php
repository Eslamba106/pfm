<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoom extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $connection = 'tenant';

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function unit_management(){
        return $this->belongsTo(UnitManagement::class , 'room_id' , 'id');
    }
}
