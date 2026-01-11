<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
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
    public function isUsed(): bool
    {
        return DB::connection($this->connection)
            ->table('proposal_units_services')
            ->where('other_charge_type', $this->id)
            ->exists();
    }
}
