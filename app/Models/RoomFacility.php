<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFacility extends Model
{
    use HasFactory;
    protected $guarded = []; 
    protected $connection = 'tenant';
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_room_facility', 'room_facility_id', 'room_id');
    }

}
