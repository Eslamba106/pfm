<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';

    public function unit_description(){
        return $this->belongsTo(UnitDescription::class  , 'unit_description_id');
    }

}
