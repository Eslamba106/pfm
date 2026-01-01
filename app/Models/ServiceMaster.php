<?php

namespace App\Models;

use App\Models\hierarchy\MainLedger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceMaster extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $connection = 'tenant';

        public function service_ledger()
    {
        return $this->hasOne(MainLedger::class, 'main_id', 'id')
            ->whereHas('group', function ($q) { 
                $q->where('id', 47);
            });
    }

}
