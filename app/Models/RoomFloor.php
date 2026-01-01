<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFloor extends Model
{
    use HasFactory;
    protected $guarded = [];

      public function building(){
        return $this->belongsTo(RoomBuilding::class , 'building_id' ,'id');
    }
    public function block(){
        return $this->belongsTo(RoomBlock::class , 'block_id' ,'id');
    }

}
