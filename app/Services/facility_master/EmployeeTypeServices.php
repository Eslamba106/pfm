<?php

namespace App\Services\facility_master;

use App\Repo\facility_master\EmployeeTypeRepo;
use App\Services\property_master\PropertyMasterServices;


class EmployeeTypeServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(EmployeeTypeRepo $repo){
        $this->repo = $repo;
    }


}
