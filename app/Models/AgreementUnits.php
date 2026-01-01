<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgreementUnits extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';

    public function agreement_unit_services(){
        return $this->hasMany(AgreementUnitsService::class , 'agreement_unit_id');
    }
    public function agreement_units(){
        return $this->belongsTo(UnitManagement::class , 'unit_id');
    }
    public function agreement_unit_main(){
        return $this->belongsTo(UnitManagement::class , 'unit_id');
    }
    public function agreement(){
        return $this->belongsTo(Agreement::class , 'agreement_id');
    }
    // public function agreemenschedulet_unit_main(){
    //     return $this->belongsTo(UnitManagement::class , 'unit_id');
    // }
}
