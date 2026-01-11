<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnquiryStatus extends Model
{
    use HasFactory;
    protected $connection = 'tenant';

    protected $guarded =   [];

    public function isUsed(): bool
    {
        return DB::connection($this->connection)
            ->table('enquiry_details')
            ->where('enquiry_status_id', $this->id)
            ->exists();
    }
}
