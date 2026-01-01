<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;


    protected $guarded = [];
    protected $connection = 'tenant';

    public function main_unit(){
        return $this->belongsTo(UnitManagement::class , 'unit_id');
    }

    public function tenant(){
        return $this->belongsTo(Tenant::class , 'tenant_id');
    }

    public function agreement(){
        return $this->belongsTo(Agreement::class , 'agreement_id');
    }
}
