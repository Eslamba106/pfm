<?php

namespace App\Repo\facility_master;

use App\Models\EmployeeType;
use App\Repo\property_master\PropertyMasterRepo;


class EmployeeTypeRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(EmployeeType::class);
    }

}
