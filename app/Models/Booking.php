<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $connection = 'tenant';

    public function tenant(){
        return $this->belongsTo(Tenant::class , 'tenant_id');
    }

    public function booking_details(){
        return $this->hasOne(BookingDetails::class , 'booking_id');
    }
}
