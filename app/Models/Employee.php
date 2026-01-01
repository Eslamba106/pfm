<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'employees'; 
    protected $connection = 'tenant';

    public function department(){
        return $this->belongsTo(Department::class , 'department_id');
    }
      public function role(){
        return $this->belongsTo(AdminRole::class,'role_id');
    }

}
