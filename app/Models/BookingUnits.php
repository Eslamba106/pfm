<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingUnits extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';
    public function booking(){
        return $this->belongsTo(Booking::class , 'booking_id');
    }
    public function unit_management(){
        return $this->belongsTo(UnitManagement::class , 'unit_id');
    }
    
}
