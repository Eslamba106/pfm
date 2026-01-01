<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgreementUnitsService extends Model
{
    use HasFactory;
    // protected $connection = 'tenant';

    protected $guarded = [];
    public function agreement_unit(){
        return $this->belongsTo(AgreementUnits::class , 'agreement_unit_id');
    }

    public function service_master(){
        return $this->belongsTo(ServiceMaster::class , 'other_charge_type');
    } 
}
