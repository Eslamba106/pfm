<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;
    protected $connection = 'tenant';

    protected $guarded = [];
    public function property_management()
    {
        return $this->belongsToMany(PropertyManagement::class, 'property_management_id');
    }

}
