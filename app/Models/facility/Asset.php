<?php

namespace App\Models\facility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $table = 'assets'; 
    protected $guarded = [];
    protected $connection = 'tenant';

    public function main_supplier(){
        return $this->belongsTo(Supplier::class,"supplier_id","id");
    }

    public function main_asset_group(){
        return $this->belongsTo(AssetGroup::class,"asset_group_id","id");
    }
}
