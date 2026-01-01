<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryMaster extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $connection = 'tenant';

    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function region(){
        return $this->belongsTo(Region::class);
    }
}
