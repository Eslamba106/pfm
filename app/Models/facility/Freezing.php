<?php

namespace App\Models\facility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freezing extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';

}
