<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitDescription extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';
    public function isUsed(): bool
    {
        return DB::connection($this->connection)
            ->table('unit_management')
            ->where('unit_description_id', $this->id)
            ->exists();
    }
}
