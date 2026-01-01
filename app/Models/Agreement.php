<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $connection = 'tenant';

    public function tenant(){
        return $this->belongsTo(Tenant::class , 'tenant_id');
    }

    public function agreement_details(){
        return $this->hasOne(AgreementDetails::class , 'agreement_id');
    }
    public function agreement_units(){
        return $this->hasMany(AgreementUnits::class , 'agreement_id');
    }
    public function schedules(){
        return $this->hasMany(Schedule::class , 'agreement_id' , 'id');
    }
}
