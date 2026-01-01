<?php

namespace App\Models\property_transactions;

use App\Models\Agreement;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Termination extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = 'tenant';

    public function tenant(){
        return $this->belongsTo(Tenant::class , 'tenant_id');
    }

    public function agreement(){
        return $this->belongsTo(Agreement::class , 'agreement_id');
    }

}
