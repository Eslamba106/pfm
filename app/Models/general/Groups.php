<?php

namespace App\Models\general;

use App\Models\hierarchy\MainLedger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';

    public function sub_groups()
    {
        return $this->hasMany(Groups::class, 'group_id', 'id');
    }
    public function ledgers()
    {
        return $this->hasMany(MainLedger::class, 'group_id', 'id');
    }
    public function parent_group()
    {
        return $this->belongsTo(Groups::class, 'group_id', 'id');
    }

    public function scopeParent($query)
    {
        return $query->where('group_id', 0);
    }

}
