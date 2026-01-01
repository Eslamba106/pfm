<?php

namespace App\Models\hierarchy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCenterCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = 'tenant';

    public function cost_centers(){
        return $this->hasMany(CostCenter::class , 'cost_center_category_id');
    }
}
