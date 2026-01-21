<?php

namespace App\Models;

use App\Models\hierarchy\MainLedger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalType extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';

    public function ledger(){
        return $this->belongsTo(MainLedger::class,'ledger_id' , 'id');
    }
}
