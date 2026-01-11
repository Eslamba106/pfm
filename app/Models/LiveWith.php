<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LiveWith extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';
    public function isUsed(): bool
    {
        return DB::connection($this->connection)
            ->table('tenants')
            ->where('live_with_id', $this->id)
            ->exists();
    }
}
