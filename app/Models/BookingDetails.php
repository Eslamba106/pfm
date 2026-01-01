<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetails extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $connection = 'tenant';

    public function booking_request_status(){
        return $this->belongsTo(EnquiryRequestStatus::class , 'booking_request_status_id');
    }

    public function booking_status(){
        return $this->belongsTo(EnquiryStatus::class , 'booking_status_id');
    }
}
