<?php

namespace App\Models\collections;

use App\Models\hierarchy\MainLedger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptSettings extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = 'tenant';

    public function main_ledgers()
    {
        return $this->belongsToMany(MainLedger::class, 'main_ledgers_receipt_settings' , 'receipt_settings_id', 'main_ledger_id');
    }
}
