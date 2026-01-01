<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;
    protected $guarded = [];

      public static function storeInvestment(array $data)
    {
        return self::create($data);
    }
}
