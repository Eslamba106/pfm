<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Block extends Model
{
    use HasFactory;
    protected $connection = 'tenant';


    protected $guarded = [];

    public function isUsed(): bool
    {
        return DB::connection($this->connection)
            ->table('block_management')
            ->where('block_id', $this->id)
            ->exists();
    }
}
