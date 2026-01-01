<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockManagement extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';

    public function block(){
        return $this->belongsTo(Block::class,"block_id","id");
    }
    // public function block_main(){
    //     return $this->hasOne(Block::class,"block_id","id");
    // }
    public function property_block_management(){
        return $this->belongsTo(PropertyManagement::class,"property_management_id","id");
    }
    public function floors_management_child(){
        return $this->hasMany(FloorManagement::class,"block_management_id","id");
    }
}
