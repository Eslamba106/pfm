<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = 'tenant';

    public function main_complaint_category(){
        return $this->belongsTo(ComplaintCategory::class , 'complaint_category_id');
        
    }
}
