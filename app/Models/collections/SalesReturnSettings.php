<?php

namespace App\Models\collections;

use App\Models\hierarchy\MainLedger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesReturnSettings extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function ledger()
    {
        return $this->belongsTo(MainLedger::class, 'ledger_id');
    }
}
