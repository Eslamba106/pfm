<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyType extends Model
{
    use HasFactory;
    protected $connection = 'tenant';

    protected $guarded = [];
    public function property_management()
    {
        return $this->belongsToMany(PropertyManagement::class, 'property_management_id');
    }
    public function isUsed(): bool
    {
        return DB::connection($this->connection)
            ->table('property_type_property_management')
            ->where('property_type_id', $this->id)
            ->exists();
    }
    // public function isUsed(): bool
    // {
    //     return $this->properties()->exists();
    // }
}
