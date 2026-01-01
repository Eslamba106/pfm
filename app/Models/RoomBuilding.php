<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBuilding extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function blocks(){
        return $this->hasMany(RoomBlock::class , 'building_id' ,'id');
    }
    public function floors(){
        return $this->hasMany(RoomFloor::class , 'building_id' ,'id');
    }
}
