<?php

namespace App\Models\collections;

use App\Models\hierarchy\MainLedger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receipt extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = 'tenant';

    public function receipt_items(){
        return $this->hasMany(ReceiptItems::class , 'receipt_id');
    }
    public function payment_methods()
    {
        return $this->belongsToMany(MainLedger::class, 'receipts_payment_method', 'receipt_id', 'main_ledger_id');
    }
    
}
