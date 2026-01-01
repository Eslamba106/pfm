<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function options()
    {
        return $this->belongsToMany(RoomOption::class, 'room_room_option', 'room_id', 'room_option_id');
    }
    public function facilities()
    {
        return $this->belongsToMany(RoomFacility::class, 'room_room_facility', 'room_id', 'room_facility_id');
    }

}
