<?php

namespace App\Services\facility_master;

use App\Repo\facility_master\EmployeeRepo;
use App\Services\property_master\PropertyMasterServices;


class EmployeeServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(EmployeeRepo $repo){
        $this->repo = $repo;
    }


}
