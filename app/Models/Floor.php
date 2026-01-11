<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Floor extends Model
{
    use HasFactory;
    protected $connection = 'tenant';

    protected $guarded = [];
    public function isUsed(): bool
    {
        return DB::connection($this->connection)
            ->table('floor_management')
            ->where('floor_id', $this->id)
            ->exists();
    }
}
