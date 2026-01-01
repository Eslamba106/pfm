<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalUnits extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';
    public function proposal(){
        return $this->belongsTo(Proposal::class , 'proposal_id');
    }
     public function unit_management(){
        return $this->belongsTo(UnitManagement::class , 'unit_id');
    }
}
