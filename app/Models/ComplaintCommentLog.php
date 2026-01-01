<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintCommentLog extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'tenant';

    public function auther(){
        return $this->belongsTo(User::class,'updated_by');
    }

}
