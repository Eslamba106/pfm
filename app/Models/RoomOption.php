<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomOption extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_room_option', 'room_option_id', 'room_id');
    }

}
