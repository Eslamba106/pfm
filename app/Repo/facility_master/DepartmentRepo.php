<?php

namespace App\Repo\facility_master;

use App\Models\Department;
use App\Repo\property_master\PropertyMasterRepo;


class DepartmentRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(Department::class);
    }

}
