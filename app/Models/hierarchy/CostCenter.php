<?php

namespace App\Models\hierarchy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';

    public function cost_center_category(){
        return $this->belongsTo(CostCenterCategory::class , 'cost_center_category_id');
    }
}
