<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;


    protected $guarded = [];
    protected $connection = 'tenant';

    public function main_unit(){
        return $this->belongsTo(UnitManagement::class , 'unit_id');
    }

    public function tenant(){
        return $this->belongsTo(Tenant::class , 'tenant_id');
    }

    public function agreement(){
        return $this->belongsTo(Agreement::class , 'agreement_id');
    }
  public function getTotalAmountAttribute()
    {
        $month = Carbon::now()->format('Y-m');

        $servicesTotal = self::where('unit_id', $this->unit_id)
            ->where('category', 'service')
            ->where('billing_month_year', $month)
            ->sum('total_service_amount');

        return ($this->rent_amount ?? 0) + $servicesTotal;
    }
}
