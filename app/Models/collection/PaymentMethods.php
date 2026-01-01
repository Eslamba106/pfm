<?php

namespace App\Models\collection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    use HasFactory;
    protected $table = 'payment_methods';
    protected $guarded = [];
    protected $connection = 'tenant';

}
