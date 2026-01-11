<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitType extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';

    public function unit_description(){
        return $this->belongsTo(UnitDescription::class  , 'unit_description_id');
    }
        public function isUsed(): bool
    {
        return DB::connection($this->connection)
            ->table('unit_management')
            ->where('unit_type_id', $this->id)
            ->exists();
    }
}
