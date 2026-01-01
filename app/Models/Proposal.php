<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $connection = 'tenant';

    public function tenant(){
        return $this->belongsTo(Tenant::class , 'tenant_id');
    }

    public function proposal_details(){
        return $this->hasOne(ProposalDetails::class , 'proposal_id');
    }
    public function proposal_unit(){
        return $this->hasMany(ProposalUnits::class , 'proposal_id');
    }
}
