<?php

namespace App\Models\collections;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptItems extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';

    public function receipt(){
        return $this->belongsTo(Receipt::class, 'receipt_id');
    }
    
}
