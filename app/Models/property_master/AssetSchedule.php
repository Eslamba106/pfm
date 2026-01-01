<?php

namespace App\Models\property_master;

use App\Models\facility\AmcProvider;
use App\Models\facility\Asset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetSchedule extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = 'tenant';

   
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function amc()
    {
        return $this->belongsTo(AmcProvider::class, 'amc_id'); 
    }
}
