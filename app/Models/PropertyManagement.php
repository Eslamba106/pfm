<?php

namespace App\Models;

use App\Models\general\Groups;
use App\Models\facility\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyManagement extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, "insurance_provider", "id");
    }
    public function ownership()
    {
        return $this->belongsTo(Ownership::class, "ownership_id", "id");
    }
    public function country_master()
    {
        return $this->belongsTo(CountryMaster::class, "country_master_id", "id");
    }
    public function blocks_management_child()
    {
        return $this->hasMany(BlockManagement::class, "property_management_id", "id");
    }
    public function units_managment()
    {
        return $this->hasMany(UnitManagement::class, "property_management_id", "id");
    }
    public function property_types()
    {
        return $this->belongsToMany(
            PropertyType::class,
            'property_type_property_management',
            'property_management_id',
            'property_type_id'
        );
    }

    public function investment()
    {
        return $this->belongsTo(Investment::class, 'investment_id', 'id');
    }
}
