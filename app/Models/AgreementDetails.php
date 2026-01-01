<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgreementDetails extends Model
{
    use HasFactory;
    protected $connection = 'tenant';

    protected $guarded =[];
    public function agreement_request_status(){
        return $this->belongsTo(EnquiryRequestStatus::class , 'agreement_request_status_id');
    }

    public function agreement_status(){
        return $this->belongsTo(EnquiryStatus::class , 'agreement_status_id');
    }
}
