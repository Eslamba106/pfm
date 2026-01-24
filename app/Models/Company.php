<?php

namespace App\Models;

use App\Models\ScheduleCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $connection = 'tenant';

    // protected $connection = 'tenant';
    public function schedule(){
        return $this->hasMany(ScheduleCompany::class , 'company_id' , 'id');
    }

    public function master_region(){
        return $this->belongsTo(Region::class , 'region');
    }

    public function schema(){
        return $this->belongsTo(Schema::class , 'schema_id');
    }
    public function country_master(){
        return $this->belongsTo(CountryMaster::class , 'countryid');
    }
    public function levy(){
        return $this->belongsTo(Levy::class , 'levy_id' , 'id');
    }
}
