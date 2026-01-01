<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $connection = 'tenant';
    protected $connection = 'tenant';

    public function children() {
        return $this->hasMany($this, 'section_group_id', 'id');
    }
}
