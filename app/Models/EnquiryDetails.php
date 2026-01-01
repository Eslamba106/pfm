<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryDetails extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = 'tenant';

    public function enquiry_request_status(){
        return $this->belongsTo(EnquiryRequestStatus::class , 'enquiry_request_status_id');
    }

    public function enquiry_status(){
        return $this->belongsTo(EnquiryStatus::class , 'enquiry_status_id');
    }
    public function agent(){
        return $this->belongsTo(Agent::class , 'agent_id');
    }
    public function employee(){
        return $this->belongsTo(Employee::class , 'employee_id');
    }
}
