<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitParking extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';

    public function isUsed(): bool
    {
        return DB::connection($this->connection)
            ->table('unit_management')
            ->where('unit_parking_id', $this->id)
            ->exists();
    }
}
