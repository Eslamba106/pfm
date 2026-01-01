<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = 'tenant';

    public function country_master(){
        return $this->belongsTo(CountryMaster::class , 'country_id' , 'id');
    }
    public static function storeAgent(array $data)
    {
        return self::create($data);
    }
}
