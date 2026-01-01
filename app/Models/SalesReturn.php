<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReturn extends Model
{
    use HasFactory;

        protected $guarded = [];
    public function items(){
        return $this->hasMany(SalesReturnItem::class , 'invoice_return_id');
    }

    public function tenant()
{
    return $this->belongsTo(Tenant::class, 'tenant_id');
}
}
