<?php

namespace App\Models\facility_transactions;

use App\Models\Unit;
use App\Models\Tenant;
use App\Models\Employee;
use App\Models\Complaint;
use App\Models\Attachment;
use App\Models\Department;
use App\Models\UnitManagement;
use App\Models\BlockManagement;
use App\Models\FloorManagement;
use App\Models\ComplaintCategory;
use App\Models\facility\Priority;
use App\Models\PropertyManagement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComplaintRegistration extends Model
{
    use HasFactory;

    protected $guarded =[];
    protected $connection = 'tenant';

    public function tenant(){
        return $this->belongsTo(Tenant::class , 'tenant_id' , 'id');
    }

    public function unit_management()
    {
        return $this->belongsTo(UnitManagement::class, 'unit_management_id');
    }
    public function property()
    {
        return $this->belongsTo(PropertyManagement::class, 'property_management_id');
    }
    public function block()
    {
        return $this->belongsTo(BlockManagement::class, 'block_id');
    }
    public function floor()
    {
        return $this->belongsTo(FloorManagement::class, 'floor_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function complaintCategory()
    {
        return $this->belongsTo(ComplaintCategory::class, 'complaint_category');
    }
    public function ComplaintMain()
    {
        return $this->belongsTo(Complaint::class, 'complaint');
    }
    public function MainDepartment()
    {
        return $this->belongsTo(Department::class, 'department');
    }
    public function MainPriority()
    {
        return $this->belongsTo(Priority::class, 'priority');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    } 
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

}
