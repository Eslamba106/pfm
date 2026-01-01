<?php

namespace App\Models\property_management;

use App\Models\UnitManagement;
use App\Models\BlockManagement;
use App\Models\FloorManagement;
use App\Models\PropertyManagement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentPriceList extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function property(){
        return $this->belongsTo(PropertyManagement::class , 'property_id'  );
    }
    public function block_management(){
        return $this->belongsTo(BlockManagement::class , 'block_management_id' );
    }
    public function floor_management(){
        return $this->belongsTo(FloorManagement::class , 'floor_management_id'  );
    }
    public function unit_management(){
        return $this->belongsTo(UnitManagement::class , 'unit_management_id' );
    }
}
