<?php

namespace App\Models\hierarchy;

use App\Models\general\Groups;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainLedger extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = 'tenant';

    public function group(){
        return $this->belongsTo(Groups::class , 'group_id');
    }

  

}
