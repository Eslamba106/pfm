<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalDetails extends Model
{
    use HasFactory;
    protected $connection = 'tenant';

    protected $guarded =[];
    public function proposal_request_status(){
        return $this->belongsTo(EnquiryRequestStatus::class , 'proposal_request_status_id');
    }

    public function proposal_status(){
        return $this->belongsTo(EnquiryStatus::class , 'proposal_status_id');
    }
    public function employee(){
        return $this->belongsTo(Employee::class , 'employee_id');
    }
    public function agent(){
        return $this->belongsTo(Agent::class , 'agent_id');
    }
}
