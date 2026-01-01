<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReturnItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    
    public function invoice()
    {
        return $this->belongsTo(SalesReturn::class, 'invoice_return_id');
    }

    public function unit_management()
    {
        return $this->belongsTo(UnitManagement::class, 'unit_id');
    }
    public function agreement()
    {
        return $this->belongsTo(Agreement::class, 'agreement_id');
    }

    public function building()
    {
        return $this->belongsTo(PropertyManagement::class, 'building_id');
    }
}
