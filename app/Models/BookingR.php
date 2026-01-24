<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingR extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $connection = 'tenant';

    protected $table = 'booking_r';
    public function rooms()
    {
        return $this->hasMany(BookingRoom::class, 'booking_id', 'id')->with('room');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

     public function scopeActive($query)
    {
        return $query->where('status', '!=','check_in');  
    }
}
