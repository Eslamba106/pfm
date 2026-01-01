<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';

    public function tenant(){
        return $this->belongsTo(Tenant::class , 'tenant_id');
    }

    public function enquiry_details(){
        return $this->hasOne(EnquiryDetails::class , 'enquiry_id');
    }

    public function enquiry_unit_search(){
        return $this->hasMany(EnquiryUnitSearchDetails::class , 'enquiry_id');
    }
}
