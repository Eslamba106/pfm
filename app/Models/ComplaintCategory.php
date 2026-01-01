<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = 'tenant';

    public function main_department(){
        return $this->belongsTo(Department::class , 'department_id');
    }
}
