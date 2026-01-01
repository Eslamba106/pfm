<?php

namespace App\Repo\facility_master;

use App\Models\Employee;
use App\Repo\property_master\PropertyMasterRepo;


class EmployeeRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(Employee::class);
    }

}
